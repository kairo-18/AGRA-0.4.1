var config = {
    type: Phaser.AUTO,
    scale: {
        mode: Phaser.Scale.EXACT_FIT,
        autoCenter: Phaser.Scale.CENTER_BOTH,
        parent: "minigame",
        width: 1000,
        height: 1000
    },
    scene: {
        preload: preload,
        create: create,
        update: update
    },
    physics: {
        default: 'arcade',
        arcade: {
            gravity: { y: 0 },
            debug: false
        }
    },
    audio: {
        disableWebAudio: false
    }
};

var game = new Phaser.Game(config);

var monsterHealthBar, playerHealthBar;
var maxPlayerHealth = 100;
var currentMonsterHealth;
var monsterNumber;
var currentPlayerHealth = maxPlayerHealth;
var playerHealthWidth;
var calculate = currentMonsterHealth / 20;
var playerHealthText;
var enemyList = ['monster1', 'monster2', 'monster3', 'monster4', 'monster5'];
var monsterList = [];
var monsterGroup;
var monster;
var playerIsAttacking = false;
var monsterIsAttacking = false;
var isAttackInProgress = false;
var playerIsMoving = false;
var monsterIsMoving = false;
var hitMusic, killMusic, walkMusic, swingMusic;


function calculateMaxMonsterHealth(calculate) {
    currentMonsterHealth = calculate * 20;
    monsterNumber = calculate;
}

console.log(maxPlayerHealth);

function preload() {
    this.load.image('backgroundTileset', '/FITBAssets/tilesetFull.png');
    this.load.tilemapTiledJSON('background', '/FITBAssets/background.json');
    this.load.atlas('monster1', '/FITBAssets/monster1.png', '/FITBAssets/monster1.json');
    this.load.atlas('monster2', '/FITBAssets/monster2.png', '/FITBAssets/monster2.json');
    this.load.atlas('monster3', '/FITBAssets/monster3.png', '/FITBAssets/monster3.json');
    this.load.atlas('monster4', '/FITBAssets/monster4.png', '/FITBAssets/monster4.json');
    this.load.atlas('monster5', '/FITBAssets/monster5.png', '/FITBAssets/monster5.json');
    this.load.atlas('player', '/FITBAssets/player.png', '/FITBAssets/player.json');
    this.load.image('container', '/FITBAssets/healthContainerAsset.png');
    this.load.script('webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js');

    this.load.audio('bgm', [
        '/IntermediateGameAssets/background.mp3'
    ]);
    this.load.audio('hit', [
        '/IntermediateGameAssets/hit.wav'
    ]);
    this.load.audio('kill', [
        '/IntermediateGameAssets/kill.wav'
    ]);
    this.load.audio('walk', [
        '/IntermediateGameAssets/walk.mp3'
    ]);
    this.load.audio('swing', [
        '/IntermediateGameAssets/swing.wav'
    ]);this.load.audio('narration', [
        '/IntermediateGameAssets/INTERMEDIATENarration.mp3'
    ]);
}

function create() {
    scene = this;

    this.sound.pauseOnBlur = true;

    const music = this.sound.add('bgm', { loop: true, volume: 0.25 });
    walkMusic = this.sound.add('walk', { volume: 2, rate: 2 });
    walkMusic.setSeek(2);
    hitMusic = this.sound.add('hit', { volume: 2 });
    killMusic = this.sound.add('kill', { volume: 2 });
    swingMusic = this.sound.add('swing', { volume: 2 });
    narrationMusic = this.sound.add('narration', { volume: 2 });


    music.play();
    narrationMusic.play();

    //Add Background
    const map = this.make.tilemap({ key: 'background' });
    const tiles = map.addTilesetImage('backgroundTileset', 'backgroundTileset');
    layer1 = map.createLayer('ground', 'backgroundTileset');
    layer1.setScale(3.15);
    layer2 = map.createLayer('wall', 'backgroundTileset');
    layer2.setScale(3.15);
    layer3 = map.createLayer('object', 'backgroundTileset');
    layer3.setScale(3.15);

    //Add Characters
    player = this.physics.add.sprite(250, 500, 'player').setScale(2.5);
    player.setBodySize(50, 50);
    player.setVelocityX(0);

    this.anims.create({
        key: 'playerIdle',
        frames: this.anims.generateFrameNames('player', { prefix: 'idle', end: 7, zeroPad: 2 }),
        frameRate: 8,
        repeat: -1
    });
    this.anims.create({
        key: 'playerRun',
        frames: this.anims.generateFrameNames('player', { prefix: 'run', end: 7, zeroPad: 2 }),
        frameRate: 8,
        repeat: -1
    });
    this.anims.create({
        key: 'playerHurt',
        frames: this.anims.generateFrameNames('player', { prefix: 'hurt', end: 3, zeroPad: 2 }),
        frameRate: 4,
        repeat: 0
    });
    this.anims.create({
        key: 'playerAttack',
        frames: this.anims.generateFrameNames('player', { prefix: 'attack', end: 15, zeroPad: 2 }),
        frameRate: 15,
        repeat: 0
    });
    player.play('playerIdle');

    monsterGroup = this.physics.add.group({
        maxSize: monsterNumber // Set the maximum size of the group
    });
    createAnimations(scene);
    // Call spawnMonster initially
    spawnMonster(monsterGroup);

    //Add Container
    this.add.image(500, 200, 'container');
    this.add.image(500, 790, 'container').setScale(1, 0.85);

    // Add monster health bar graphics
    monsterHealthBar = this.add.graphics().setScale(1.0);
    updateMonsterHealthBar();

    //Add player health bar graphics
    playerHealthBar = this.add.graphics().setScale(1.0);
    updatePlayerHealthBar();

    const add = this.add;

    WebFont.load({
        google: {
            families: ['VT323']
        },
        active: function () {
            add.text(275, 745, 'Player Health', { fontFamily: 'VT323', fontSize: '30px' });
            playerHealthText = add.text(630, 815, '', { fontFamily: 'VT323', fontSize: '30px' });

            add.text(265, 150, 'Monster Count', { fontFamily: 'VT323', fontSize: '30px' });
            monsterCount = add.text(630, 150, '', { fontFamily: 'VT323', fontSize: '30px' });
        },
        // Handle font loading error
        inactive: function () {
            console.error('Font loading failed.');
        }
    });
}

function update() {
    if (playerHealthText) {
        // Round currentPlayerHealth and maxPlayerHealth to the nearest integer
        const roundedCurrentHealth = Phaser.Math.RoundTo(currentPlayerHealth, 0);
        const roundedMaxHealth = Phaser.Math.RoundTo(maxPlayerHealth, 0);

        playerHealthText.setText(`${roundedCurrentHealth}/${roundedMaxHealth}`);
    }
}


function spawnMonster(monsterGroup) {
    // Check if there's already a monster in the group
    if (monsterGroup.getLength() > 0) {
        // If so, destroy the existing monster
        const existingMonster = monsterGroup.getFirstAlive();
        existingMonster.destroy();
    }
    // Spawn a new monster
    const randomMonsterKey = Phaser.Math.RND.pick(enemyList);
    monster = monsterGroup.create(750, 500, randomMonsterKey);
    monster.setScale(3);
    monster.setBodySize(50, 50);
    monster.flipX = true;
    monsterList.push(monster);
    monster.play(`${randomMonsterKey}Idle`);
}

function createAnimations(scene){
    // Dynamically create animations for all monsters
    for (let i = 0; i < enemyList.length; i++) {
        var monsterKey = enemyList[i];
        let idleFrameEnd, runFrameEnd, hurtFrameEnd, attackFrameEnd;

        // Set frame ends based on monster type
        switch (monsterKey) {
            case 'monster5':
                idleFrameEnd = 17;
                runFrameEnd = 7;
                attackFrameEnd = 20;
                hurtFrameEnd = 6;
                break;
            case 'monster4':
                idleFrameEnd = 14;
                runFrameEnd = 7;
                attackFrameEnd = 21;
                hurtFrameEnd = 6;
                break;
            case 'monster3':
                idleFrameEnd = 49;
                runFrameEnd = 9;
                attackFrameEnd = 46;
                hurtFrameEnd = 8;
                break;
            case 'monster2':
                idleFrameEnd = 7;
                runFrameEnd = 9;
                attackFrameEnd = 24;
                hurtFrameEnd = 6;
                break;
            case 'monster1':
                idleFrameEnd = 8;
                runFrameEnd = 5;
                attackFrameEnd = 11;
                hurtFrameEnd = 4;
                break;
            default:
                console.error('Unknown monster type:', monsterKey);
                break;
        }

        // Create animations using the calculated frame ends
        scene.anims.create({
            key: `${monsterKey}Idle`,
            frames: scene.anims.generateFrameNames(monsterKey, { prefix: 'idle', end: idleFrameEnd, zeroPad: 2 }),
            frameRate: idleFrameEnd * 0.75,
            repeat: -1
        });

        scene.anims.create({
            key: `${monsterKey}Run`,
            frames: scene.anims.generateFrameNames(monsterKey, { prefix: 'run', end: runFrameEnd, zeroPad: 2 }),
            frameRate: runFrameEnd * 0.75,
            repeat: -1
        });

        scene.anims.create({
            key: `${monsterKey}Hurt`,
            frames: scene.anims.generateFrameNames(monsterKey, { prefix: 'hurt', end: hurtFrameEnd, zeroPad: 2 }),
            frameRate: hurtFrameEnd * 0.75,
            repeat: 0
        });

        scene.anims.create({
            key: `${monsterKey}Attack`,
            frames: scene.anims.generateFrameNames(monsterKey, { prefix: 'attack', end: attackFrameEnd, zeroPad: 2 }),
            frameRate: attackFrameEnd * 0.75,
            repeat: 0
        });
    }

}

// Function to update player health bar
function updatePlayerHealthBar() {
    playerHealthBar.clear();

    // Ensure current health is not less than 0
    playerHealthWidth = Math.max(0, 450 * (currentPlayerHealth / maxPlayerHealth));

    // Check if health is greater than 0 to draw the health bar
    if (currentPlayerHealth > 0) {
        // Fill the inner rectangle
        playerHealthBar.fillStyle(0x40D90B, 1);
        playerHealthBar.fillRoundedRect(275, 780, playerHealthWidth, 30, 20).setDepth(3);

        // Define border properties
        playerHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        playerHealthBar.strokeRoundedRect(275, 780, playerHealthWidth, 30, 20).setDepth(3);
    }
}

// Function to reduce player health
function reducePlayerHealth(amount) {
    // Calculate the amount based on maxPlayerHealth divided by monsterNumber
    const calculatedAmount = maxPlayerHealth / monsterNumber;
    currentPlayerHealth -= calculatedAmount;
    currentPlayerHealth = Math.max(currentPlayerHealth, 0); // Ensure health doesn't go below 0
    updatePlayerHealthBar();
}

// Function to update monster health bar
function updateMonsterHealthBar() {
    monsterHealthBar.clear();

    // Ensure current health is not less than 0
    var numCircles = Math.ceil(currentMonsterHealth / 20); // Calculate the number of circles based on current health

    // Define circle properties
    var circleRadius = 10;
    var circleSpacing = 10;
    var startX = 275; // Initial x position for the first circle
    var y = 200; // y position for all circles
    var borderWidth = 4; // Border width for the circles

    // Darker red color
    var darkerRed = Phaser.Display.Color.ValueToColor(0x990000);

    // Draw circles for each health interval
    for (let i = 0; i < numCircles; i++) {
        var x = startX + (circleRadius * 2 + circleSpacing) * i; // Calculate x position for the current circle
        monsterHealthBar.fillStyle(darkerRed.color, 1); // Use darker red color for the circle
        monsterHealthBar.fillCircle(x, y, circleRadius); // Draw the circle

        // Draw circle border
        monsterHealthBar.lineStyle(borderWidth, 0x000000, 1); // Black color for the border
        monsterHealthBar.strokeCircle(x, y, circleRadius); // Draw the border of the circle
    }
}

// Function to reduce monster health
function reduceMonsterHealth(amount) {
    currentMonsterHealth -= amount;
    currentMonsterHealth = Math.max(currentMonsterHealth, 0); // Ensure health doesn't go below 0
    updateMonsterHealthBar();
}

//Function for Monster hitting Player
function shakeCamera(scene) {
    scene.cameras.main.shake(500, 0.007);
    //damage player
    reducePlayerHealth(20);
}

//Function for having a fade-in transition
function fadeTransition(camera, duration) {
    camera.fadeOut(duration, 0, 0, 0);
    camera.fadeIn(duration, 0, 0, 0);
}

function playerMove(scene) {

    if (!monsterIsAttacking && !playerIsMoving && !isAttackInProgress) {
        isAttackInProgress = true;
        playerIsMoving = true;

        player.setVelocityX(500);
        player.play('playerRun');
        walkMusic.play();
        scene.time.delayedCall(700, function () {
            walkMusic.stop();
            swingMusic.play();
            player.setVelocityX(0);
            player.play('playerAttack');

        });

        player.once('animationcomplete', function (animation) {
            if (animation.key === 'playerAttack') {
                swingMusic.stop();
                killMusic.play();
                reduceMonsterHealth(20);
                fadeTransition(scene.cameras.main, 1500);
                player.x = 250;
                player.play('playerIdle');

                playerIsMoving = false;
                isAttackInProgress = false;

                spawnMonster(monsterGroup);
            }
        });
    }
}

function monsterMove() {
    if (!playerIsAttacking && !monsterIsMoving && !isAttackInProgress) {

        isAttackInProgress = true;
        monsterIsMoving = true;

        monster.play(`${monster.texture.key}Run`);
        monster.setVelocityX(-500);
        walkMusic.play();

        scene.time.delayedCall(700, function () {
            walkMusic.stop();
            swingMusic.play();
            monster.setVelocityX(0);
            monster.play(`${monster.texture.key}Attack`);
        });

        monster.once('animationcomplete', function (animation) {
            if (animation.key === `${monster.texture.key}Attack`) {
                swingMusic.stop();
                hitMusic.play();
                player.play('playerHurt');
                shakeCamera(scene);

                scene.time.delayedCall(500, function () {
                    player.play('playerIdle');
                });

                monster.x = 750;
                monster.play(`${monster.texture.key}Idle`);

                monsterIsMoving = false;
                isAttackInProgress = false;
            }
        });
    }
}

