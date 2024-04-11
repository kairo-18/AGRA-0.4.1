let monsterTween;
let playerTween;
let bulletTween;
let monsterHealthBar, playerHealthBar;
let maxPlayerHealth = 100;
let currentMonsterHealth = maxMonsterHealth;
let currentPlayerHealth = maxPlayerHealth;
let music;
let player;
let monster;
let bullet;
let scene;

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
    audio: {
        disableWebAudio: true
    }
};

var game = new Phaser.Game(config);

function preload() {

    this.load.atlas('char', '/charspritesheet(1).png', '/charsprites(1).json');
    for (let i = 0; i <= 9; i++) {
        this.load.image('attack' + i, '/shipEnemyGoblin/Attack_00' + i + '.png');
    }

    for (let i = 0; i <= 9; i++) {
        this.load.image('hurt' + i, '/shipEnemyGoblin/Hurt_00' + i + '.png');
    }

    for (let i = 0; i <= 9; i++) {
        this.load.image('idle' + i, '/shipEnemyGoblin/Idle_00' + i + '.png');
    }

    for (let i = 0; i <= 9; i++) {
        this.load.image('walk' + i, '/shipEnemyGoblin/Walk_00' + i + '.png');
    }

    this.load.image('bullet', '/shipEnemyGoblin/laser.png')
    this.load.image('background', '/shipEnemyGoblin/bg.jpg');
    this.load.image('player', '/shipEnemyGoblin/player.png');
    this.load.image('monster', '/monster.png');
    this.load.image('monsterHealthBar', '/monsterHealthBar.png');
    this.load.image('playerHealthBar', '/playerHealthBar.png');
    this.load.image('greyHealth', '/greyHealth.png');
    this.load.image('healthPlayer', '/containerHealth.png')
    this.load.image('healthMonster', '/monsterHealth.png')
    this.load.audio('bgm', '/background.mp3')
    this.load.image('muteButton', '/muteButton.png')


}


function create() {
    scene = this;

    //How to add this plugin here? game.plugins.screenShake = game.plugins.add(Phaser.Plugin.ScreenShake);

    // Add background
    this.add.image(0, 0, 'background').setOrigin(0).setScale(1.7, 1.5).setOrigin(0);
    //this.cameras.main.shake(1000, 0.01); //how can i make this into a function that i can call in different file

    // Add player sprite
    player = this.add.image(500, 500, 'player').setScale(2, 2.3);
    player.setDepth(3);

    this.tweens.add({
        targets: player,
        x: '+=20', // Move player to the right by 50 pixels
        duration: 1000, // Duration of each half of the tween (move to the right and then back to the original position)
        yoyo: true, // Makes the tween reverse back to the starting position
        repeat: -1 // Repeat indefinitely
    });

    bullet = this.add.image(500,700, 'bullet').setScale(1).setDepth(2).setRotation(4);

    //this.anims.create({
        //key: 'idle',
        //frames: [{ key: 'char', frame: 0 }], // Use the first frame as the idle frame
        //repeat: -1 // Repeat indefinitely for idle animation
    //});
    //this.anims.create({key: 'punch', frames: this.anims.generateFrameNames('char', {prefix: 'punch', end: 3, zeroPad: 2}), frameRate: 6});
    //this.anims.create({key: 'dmg', frames: this.anims.generateFrameNames('char', {prefix: 'dmg', end: 2, zeroPad: 2}), frameRate: 5});

    //player = this.add.sprite(300, 750, 'char').setScale(6);

    // Create monster sprite
    monster = this.add.sprite(300, 470, 'idle0').setScale(0.5).setDepth(0);
    //monster.setScale(-6, 6);
    monster.setOrigin(0.5, 1);

    this.anims.create({
        key: 'monsterAttack',
        frames: [
            { key: 'attack0' },
            { key: 'attack1' },
            { key: 'attack2' },
            { key: 'attack3' },
            { key: 'attack4' },
            { key: 'attack5' },
            { key: 'attack6' },
            { key: 'attack7' },
            { key: 'attack8' },
            { key: 'attack9' }
        ],
        frameRate: 10, // Adjust frame rate as needed
        repeat: 0 // Set to 0 if you want the animation to play only once
    });

    this.anims.create({
        key: 'monsterWalk',
        frames: [
            { key: 'walk0' },
            { key: 'walk1' },
            { key: 'walk2' },
            { key: 'walk3' },
            { key: 'walk4' },
            { key: 'walk5' },
            { key: 'walk6' },
            { key: 'walk7' },
            { key: 'walk8' },
            { key: 'walk9' }
        ],
        frameRate: 10, // Adjust frame rate as needed
        repeat: -1 // Set to 0 if you want the animation to play only once
    });

    this.anims.create({
        key: 'monsterHurt',
        frames: [
            { key: 'hurt0' },
            { key: 'hurt1' },
            { key: 'hurt2' },
            { key: 'hurt3' },
            { key: 'hurt4' },
            { key: 'hurt5' },
            { key: 'hurt6' },
            { key: 'hurt7' },
            { key: 'hurt8' },
            { key: 'hurt9' }
        ],
        frameRate: 10, // Adjust frame rate as needed
        repeat: 0 // Set to 0 if you want the animation to play only once
    });

    this.anims.create({
        key: 'monsterIdle',
        frames: [
            { key: 'idle0' },
            { key: 'idle1' },
            { key: 'idle2' },
            { key: 'idle3' },
            { key: 'idle4' },
            { key: 'idle5' },
            { key: 'idle6' },
            { key: 'idle7' },
            { key: 'idle8' },
            { key: 'idle9' }
        ],
        frameRate: 10, // Adjust frame rate as needed
        repeat: -1, // Set to 0 if you want the animation to play only once
    });
    monster.play("monsterIdle");


    //player.on('animationcomplete', function (animation) {
        //if (animation.key === 'punch') {
            // Play the idle animation after the punch animation is complete
            //player.play('idle');
        //}else if (animation.key === 'dmg') {
            // Play the idle animation after the punch animation is complete
            //player.play('idle');
        //}
    //});

    monster.on('animationcomplete', function (animation) {
        if (animation.key === 'monsterAttack') {
            // Play the idle animation after the punch animation is complete
            monster.play('monsterIdle');
        } else if (animation.key === 'monsterHurt') {
            // Play the idle animation after the punch animation is complete
            monster.play('monsterIdle');
        }

    });







    this.add.image(255, 700, 'healthPlayer').setScale(2.0).setDepth(3);
    this.add.image(255, 120, 'healthMonster').setScale(1.6, 1);

    // Add monster health bar graphics
    monsterHealthBar = this.add.graphics().setScale(1.0);
    updateMonsterHealthBar();

    //Add player health bar graphics
    playerHealthBar = this.add.graphics().setScale(1.0);
    updatePlayerHealthBar();

    // Create the mute button
    muteButton = this.add.image(350, 0, 'muteButton').setOrigin(0).setScale(0.15).setInteractive();



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

    monsterTween = this.tweens.add({
        targets: monster,
        x: player.x,
        y: player.y,
        yoyo: true,
        persist: true,
        paused: true,
        duration: 500,
        onComplete: () => {
            reducePlayerHealth(20);
        }
    });

    playerTween = this.tweens.add({
        targets: player,
        x: monster.x,
        y: monster.y,
        duration: 500,
        yoyo: true,
        persist: true,
        paused: true,
        onComplete: () => {
            reduceMonsterHealth(20);
        }
    });

    bulletTween = this.tweens.add({
        targets: bullet,
        x: monster.x - 100,
        y: monster.y - 200,
        duration: 500,
        persist: true,
        paused: true,
        onUpdate: function(tween, target) {
            // Calculate the current progress of the tween
            const progress = tween.progress;

            // Calculate the scale value based on the progress
            const scale = 1 - progress * 0.6; // Decrease scale from 1 to 0.5 over the duration

            // Set the scale of the bullet
            target.setScale(scale);
        },
        onComplete: () => {
            // Reduce monster health when bullet hits
            reduceMonsterHealth(20);

            // Go back to the original position
            bulletTween.restart();
            bulletTween.pause();
        }
    });




    // Set up click event for the mute button
    muteButton.on('pointerup', function () {
        if (music.isPaused) {
            music.resume();
            muteButton.setTint(); // Remove tint to indicate unmuted state
        } else {
            music.pause();
            muteButton.setTint(0xff0000); // Tint red to indicate muted state
        }
    });
}

function update() {

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

function shakeCamera(scene) {
    scene.cameras.main.shake(500, 0.007);

    //damage player
    reducePlayerHealth(20);
}

