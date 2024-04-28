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
        disableWebAudio: true
    }
};

var game = new Phaser.Game(config);
var monsterHealthBar, playerHealthBar;
var maxPlayerHealth = 100;
var peopleCount = maxPlayerHealth/20;
var currentMonsterHealth = maxMonsterHealth;
var currentPlayerHealth = maxPlayerHealth;
var monsterAttacks = ['attack1', 'attack2', 'attack3'];
var explosions = ['explosion1', 'explosion2', 'explosion3']


function preload() {
    this.load.atlas('necromancer', '/necromancer.png', '/necromancer.json');
    for (let i = 0; i <= 9; i++) {
        this.load.image('attack' + i, '/shipEnemyGoblin/Attack_00' + i + '.png')
    }

    for (let i = 0; i <= 9; i++) {
        this.load.image('hurt' + i, '/shipEnemyGoblin/Hurt_00' + i + '.png')
    }

    for (let i = 0; i <= 9; i++) {
        this.load.image('idle' + i, '/shipEnemyGoblin/Idle_00' + i + '.png')
    }

    for (let i = 0; i <= 9; i++) {
        this.load.image('walk' + i, '/shipEnemyGoblin/Walk_00' + i + '.png')
    }
    this.load.image('bullet', '/shipEnemyGoblin/laser.png')
    this.load.image('background', '/shipEnemyGoblin/bg.jpg');
    this.load.image('player', '/shipEnemyGoblin/player.png');
    this.load.image('monsterHealthBar', '/monsterHealthBar.png');
    this.load.image('playerHealthBar', '/playerHealthBar.png');
    this.load.image('healthPlayer', '/containerHealth.png')
    this.load.image('healthMonster', '/monsterHealth.png')
    this.load.audio('bgm', '/background.mp3')
    this.load.image('muteButton', '/muteButton.png')
    this.load.atlas('explosion1', '/explosions/explosion1.png', '/explosions/explosion1.json');
    this.load.atlas('explosion2', '/explosions/explosion2.png', '/explosions/explosion2.json');
    this.load.atlas('explosion3', '/explosions/explosion3.png', '/explosions/explosion3.json');
    this.load.atlas('crowd', '/crowd.png', '/crowd.json');
}

function create() {
    scene = this;
    
    //Add Background
    this.add.image(0, 0, 'background').setOrigin(0).setScale(1.7, 1.5).setOrigin(0)

    player = this.add.image(500, 500, 'player').setScale(2, 2.3).setDepth(3);
    bullet = this.physics.add.sprite(500,700, 'bullet').setScale(0.4).setDepth(2);
    monster = this.physics.add.sprite(300, 270, 'necromancer').setScale(5).setDepth(2);
    monster.setImmovable();
    monster.setBodySize(50, 50);
    monster.setVelocityX(100);

    this.add.image(255, 700, 'healthPlayer').setScale(2.0).setDepth(3);
    // this.add.image(255, 120, 'healthMonster').setScale(1.6, 1);

    // Add monster health bar graphics
    monsterHealthBar = this.add.graphics().setScale(1.0);
    updateMonsterHealthBar();

    //Add player health bar graphics
    playerHealthBar = this.add.graphics().setScale(1.0);
    updatePlayerHealthBar();

    //Add Mute Button
    muteButton = this.add.image(350, 0, 'muteButton').setOrigin(0).setScale(0.15).setInteractive();

    //Add Groups 
    bullets = this.physics.add.group({
        defaultKey: 'bullet',
        maxSize: 5,
        runChildUpdate: true
    });

    people = this.physics.add.group({
        key: 'people',
        repeat: peopleCount - 1,
        setXY: { x: 550, y: 420, stepX: 50 },
        bounceX: 1,
        velocityX: 100
    });

    function hitTarget(monster, bullet) { 
        reduceMonsterHealth(20);
        monster.setVelocityX(0);
        monster.play('hurt');
        bullet.destroy(); 
        monster.on('animationcomplete', function (animation) {
            monster.play('run');
            if(monster.flipX == true){
                monster.setVelocityX(-100);
            }
            else if (monster.flipX == false){
                monster.setVelocityX(100);
            }
        });
    }

    //Add Player Default Animation
    this.tweens.add({
        targets: player,
        x: '+=20', // Move player to the right by 50 pixels
        duration: 1000, // Duration of each half of the tween (move to the right and then back to the original position)
        yoyo: true, // Makes the tween reverse back to the starting position
        repeat: -1 // Repeat indefinitely
    });

    //Add Monster Animations
    this.anims.create({
        key: 'idle',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'idle', end: 7, zeroPad: 2}),
        frameRate: 7,
        repeat: -1
    });
    this.anims.create({
        key: 'run',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'run', end: 7, zeroPad: 2}),
        repeat: -1
    });
    this.anims.create({
        key: 'attack1',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'attack1', end: 12, zeroPad: 2}),
        frameRate: 6,
        repeat: 0
    });
    this.anims.create({
        key: 'attack2',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'attack2', end: 12, zeroPad: 2}),
        frameRate: 6,
        repeat: 0
    });
    this.anims.create({
        key: 'attack3',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'attack3', end: 16, zeroPad: 2}),
        frameRate: 8,
        repeat: 0
    });
    this.anims.create({
        key: 'hurt',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'hurt', end: 4, zeroPad: 2}),
        repeat: 0
    });
    this.anims.create({
        key: 'death',
        frames: this.anims.generateFrameNames('necromancer', {prefix: 'death', end: 5, zeroPad: 2}),
        repeat: 0
    });
    monster.play('run');

    //Add Explosion Animations
    this.anims.create({
        key: 'explosion1',
        frames: this.anims.generateFrameNames('explosion1', {prefix: 'sprite', start: 1, end: 61, zeroPad: 0}),
        frameRate: 61,
        repeat: 0
    });

    this.anims.create({
        key: 'explosion2',
        frames: this.anims.generateFrameNames('explosion2', {prefix: 'sprite', start: 1, end: 65, zeroPad: 0}),
        frameRate: 65,
        repeat: 0
    });

    this.anims.create({
        key: 'explosion3',
        frames: this.anims.generateFrameNames('explosion3', {prefix: 'sprite', start: 1, end: 71, zeroPad: 0}),
        frameRate: 71,
        repeat: 0
    });

    this.anims.create({
        key: 'crowdRun',
        frames: this.anims.generateFrameNames('crowd', {prefix: 'run', start: 0, end: 15, zeroPad: 2}),
        frameRate: 15,
        repeat: -1
    });
    
    people.children.iterate(function (child) {
        child.setBounceX(Phaser.Math.FloatBetween(0.4, 0.8));
        child.setCollideWorldBounds(true);
        child.setVelocity(Phaser.Math.RND.pick([200, 150, 100, 50, -50, -100, -150, -200]), 0);
        if (child.body.velocity.x < 0) {
            child.flipX = true;
        }
        // Set other properties
        child.allowGravity = false;
        child.play('crowdRun');
    });

    //Overlap Checker for Deleting Bullets
    this.physics.add.overlap(monster, bullets, hitTarget, null, this);
}

function update() {
    //Scaling down of bullet as it travels towards monster
    bullets.children.each(function(bullet) {
        distance = Phaser.Math.Distance.Between(bullet.x, bullet.y, monster.x, monster.y);
        maxDistance = Phaser.Math.Distance.Between(player.x, player.y, monster.x, monster.y);
        scaleFactor = distance / maxDistance;
        bullet.setScale(scaleFactor);
    });

    // Update monster's velocity based on its position
    if (monster.x < 100) {
        monster.setVelocityX(Math.abs(monster.body.velocity.x)); // Move right
        monster.flipX = false; // Make sure sprite is not flipped
    } else if (monster.x > 900) {
        monster.setVelocityX(-Math.abs(monster.body.velocity.x)); // Move left
        monster.flipX = true; // Flip sprite horizontally
    }

    // Update monster health bar position to follow the monster
    monsterHealthBar.x = monster.x - 300; 
    monsterHealthBar.y = monster.y - 270; 
    
    // Ensure the health bar is always visible above other elements
    monsterHealthBar.depth = monster.depth + 1;

    //Handles collisions with people group
    people.children.iterate(function (child) {
        if (child.x <= 100) {
            child.setVelocityX(Math.abs(child.body.velocity.x)); // Move right
            child.flipX = false; // Make sure sprite is not flipped
        } else if (child.x >= 900) {
            child.setVelocityX(-Math.abs(child.body.velocity.x)); // Move left
            child.flipX = true; // Flip sprite horizontally
        }
    });
}

//Function for firing bullet
function fireBullet(){
    var bullet = this.bullets.get(this.bullet.x, this.bullet.y)
    bullet.setActive(true);
    bullet.setVisible(true);
    bullet.update = function() {
        angle = Phaser.Math.Angle.Between(bullet.x, bullet.y, monster.x, monster.y);
        bullet.setRotation(angle);
        bullet.body.velocity.x = Math.cos(angle) * 300;
        bullet.body.velocity.y = Math.sin(angle) * 300;

    }
}

// Function to update player health bar
function updatePlayerHealthBar() {
    playerHealthBar.clear();

    // Ensure current health is not less than 0
    const playerHealthWidth = Math.max(0, 250 * (currentPlayerHealth / maxPlayerHealth));

    // Check if health is greater than 0 to draw the health bar
    if (currentPlayerHealth > 0) {
        // Fill the inner rectangle
        playerHealthBar.fillStyle(0x40D90B, 1);
        playerHealthBar.fillRoundedRect(150, 700, playerHealthWidth, 30, 20).setDepth(3);

        // Define border properties
        playerHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        playerHealthBar.strokeRoundedRect(150, 700, playerHealthWidth, 30, 20).setDepth(3);
    }
}

// Function to reduce player health
function reducePlayerHealth(amount) {
    currentPlayerHealth -= amount;
    if (currentPlayerHealth < 0) {
        currentPlayerHealth = 0;
    }
    updatePlayerHealthBar();
}

// Function to update monster health bar
function updateMonsterHealthBar() {
    monsterHealthBar.clear();

    // Ensure current health is not less than 0
    const monsterHealthWidth = Math.max(0, 230 * (currentMonsterHealth / maxMonsterHealth));

    // Check if health is greater than 0 to draw the health bar
    if (currentMonsterHealth > 0) {
        // Fill the inner rectangle
        monsterHealthBar.fillStyle(0xff0000, 1);
        monsterHealthBar.fillRoundedRect(170, 120, monsterHealthWidth, 20, 10);

        // Define border properties
        monsterHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        monsterHealthBar.strokeRoundedRect(170, 120, monsterHealthWidth, 20, 10);
    }
}

// Function to reduce monster health
function reduceMonsterHealth(amount) {
    currentMonsterHealth -= amount;
    if (currentMonsterHealth < 0) {
        currentMonsterHealth = 0;
    }
    updateMonsterHealthBar();
}

//Function for Monster hitting Player
function shakeCamera(scene) {
    scene.cameras.main.shake(500, 0.007);

    //damage player
    reducePlayerHealth(20);
}

//Function for picking random attack when Monster attacks
function triggerRandomAttack() {
    // Stop previous attack animation and the velocity
    monster.anims.stop();
    monster.setVelocityX(0);

    // Select a random child from the people group
    var randomIndex = Phaser.Math.RND.integerInRange(0, people.children.size - 1);
    var randomChild = people.children.entries[randomIndex];
    
    // Get the coordinates of the selected child
    var childX = randomChild.x;
    var childY = randomChild.y;

    // Play the selected attack animation
    monster.anims.play(Phaser.Math.RND.pick(monsterAttacks));

    // Destroy the selected child and the spawned sprite after a delay
    scene.time.delayedCall(500, function() {
    // Spawn a sprite on top of the selected child
    var attackSprite = scene.physics.add.sprite(childX, childY, 'explosion1').setScale(3).setDepth(2);
    attackSprite.anims.play(Phaser.Math.RND.pick(explosions));
    randomChild.destroy();
    scene.time.delayedCall(500, function() {
        attackSprite.destroy();
        });
    });

    monster.on('animationcomplete', function (animation) {
        monster.play('run');
        if(monster.flipX == true){
            monster.setVelocityX(-100);
        }
        else if (monster.flipX == false){
            monster.setVelocityX(100);
        }
    });
}
