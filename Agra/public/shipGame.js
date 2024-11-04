var config = {
    type: Phaser.AUTO,
    scale: {
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
var peopleCount = maxPlayerHealth/20;
var currentMonsterHealth = maxMonsterHealth;
currentPlayerHealth = maxPlayerHealth;
var monsterHealth;
var monsterAttacks = ['attack1', 'attack2', 'attack3'];
var explosions = ['explosion1', 'explosion2', 'explosion3']
var crosshair, shootButton, isShooting = false, shouldRegen = true;
var isAiming = false;
var bgmMusic, shootMusic, explosionMusic, hitMusic, winMusic, loseMusic;

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
    this.load.image('crosshair', '/shipGameAssets/crosshair.png');
    this.load.image('muteButton', '/muteButton.png')
    this.load.atlas('explosion1', '/explosions/explosion1.png', '/explosions/explosion1.json');
    this.load.atlas('explosion2', '/explosions/explosion2.png', '/explosions/explosion2.json');
    this.load.atlas('explosion3', '/explosions/explosion3.png', '/explosions/explosion3.json');
    this.load.atlas('shootButton', '/shipGameAssets/shootButton.png', '/shipGameAssets/shootButton.json');
    this.load.atlas('crowd', '/crowd.png', '/crowd.json');
    this.load.audio('bgm', '/shipGameAssets/OUTPUTBgm.flac');
    this.load.audio('shoot', '/shipGameAssets/OUTPUTHit.wav');
    this.load.audio('explosion', '/shipGameAssets/OUTPUTExplosion.wav');
    this.load.audio('win', '/shipGameAssets/OUTPUTWin.wav');
    this.load.audio('lose', '/shipGameAssets/OUTPUTLose.wav');
    this.load.audio('hit', '/shipGameAssets/OUTPUTHurt.wav');
}

function create() {
    scene = this;

    bgmMusic = scene.sound.add('bgm', {volume: 0.05, loop: true});
    explosionMusic = scene.sound.add('explosion', {volume: 0.5});
    shootMusic = scene.sound.add('shoot', {volume: 0.5});
    winMusic = scene.sound.add('win', {volume: 0.5});
    loseMusic = scene.sound.add('lose', {volume: 0.5});
    hitMusic = scene.sound.add('hit', {volume: 0.5});

    bgmMusic.play();

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

    setupAimingMechanic(this); // Initialize aiming mechanic

    // Add the overlap check for bullet and monster
    this.physics.add.overlap(bullets, monster, hitTarget, null, this);

    function hitTarget(monster, bullet) {
        reduceMonsterHealth(20);
        monster.setVelocityX(0);
        monster.play('hurt');
        bullet.destroy();
        hitMusic.play();
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

    this.anims.create({
        key: 'shootButton',
        frames: this.anims.generateFrameNames('shootButton', {prefix: 'button', start: 0, end: 1, zeroPad: 2}),
        frameRate: 12,
        repeat: 0,
        yoyo: true
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

function createCrosshair() {
    // Add crosshair to the center of the screen, slightly above the player
    crosshair = scene.add.image(500, 250, 'crosshair').setDepth(4); // Ensure to load crosshair image in preload
    crosshair.setScale(0.1);

    // Tween to make the crosshair move left and right in a loop
    scene.tweens.add({
        targets: crosshair,
        x: { from: 200, to: 800 }, // Adjust left and right limits as needed
        duration: 1000,
        ease: 'Sine.easeInOut',
        yoyo: true,
        repeat: -1
    });

    // Add the shoot button
    scene.add.text(450, 900, 'SHOOT!', {
        fontSize: '100px',
        color: '#ffffff',
        padding: { x: 10, y: 5 },
        align: 'center'
    }).setDepth(6);
    shootButton = scene.add.sprite(450, 900, 'shootButton').setInteractive();
    scene.add.text(450, 900, 'shootButton').setInteractive();
    shootButton.setDepth(5); // Ensure it's above other elements

    // On shoot button click, stop the crosshair and fire at its position
    shootButton.on('pointerdown', function () {
        if (!isShooting) {
            isShooting = true;
            scene.tweens.killTweensOf(crosshair); // Stop crosshair movement
            fireBulletAtCrosshair();
        }
    });
}



function fireBulletAtCrosshair() {
    let shots = 0;
    const maxShots = 5;

    var bullet = bullets.get(player.x, player.y);
    bullet.setActive(true);
    bullet.setVisible(true);

    // Calculate angle to fire at the crosshair's current position
    var angle = Phaser.Math.Angle.Between(bullet.x, bullet.y, crosshair.x, crosshair.y);
    bullet.setRotation(angle);
    bullet.body.velocity.x = Math.cos(angle) * 300;
    bullet.body.velocity.y = Math.sin(angle) * 300;
    bullet.setSize(50, 50).setOffset(50, 50);

    // Enable world bounds check to destroy the bullet when it leaves the screen
    bullet.body.setCollideWorldBounds(true);
    bullet.body.onWorldBounds = true;

    // Add a listener to destroy the bullet when it goes out of bounds
    scene.physics.world.on('worldbounds', function(body) {
        if (body.gameObject === bullet) {
            bullet.destroy();
        }
    });

    // Detect if the bullet hits the monster
    isShooting = false;
    scene.physics.add.overlap(bullet, monster, function() {
        console.log("hit");
        bullet.destroy();
        isShooting = false; // Reset shooting status
        resetCrosshair(); // Reset crosshair movement
    });
}

// Function to reset crosshair position and movement
function resetCrosshair() {
    crosshair.x = 500; // Reset to middle
    scene.tweens.add({
        targets: crosshair,
        x: { from: 200, to: 800 }, // Left and right limits
        duration: 1000,
        ease: 'Sine.easeInOut',
        yoyo: true,
        repeat: -1
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


    function updateMonsterHealth(){
        const monsterHealthWidth = Math.max(0, 230 * (currentMonsterHealth / maxMonsterHealth));
        // Fill the inner rectangle
        monsterHealthBar.fillStyle(0xff0000, 1);
        monsterHealthBar.fillRoundedRect(170, 120, monsterHealthWidth, 20, 10);

        // Define border properties
        monsterHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        monsterHealthBar.strokeRoundedRect(170, 120, monsterHealthWidth, 20, 10);
    }
    // Check if health is greater than 0 to draw the health bar
    if (currentMonsterHealth > 0) {
        updateMonsterHealth();
    }
    // if(currentMonsterHealth <= 0 && shouldRegen){
    //     currentMonsterHealth = 100;
    //     updateMonsterHealth();
    //     hideAimingMechanic();
    // }


}

function failedAtAiming(){
    function updateMonsterHealth(){
        const monsterHealthWidth = Math.max(0, 230 * (currentMonsterHealth / maxMonsterHealth));
        // Fill the inner rectangle
        monsterHealthBar.fillStyle(0xff0000, 1);
        monsterHealthBar.fillRoundedRect(170, 120, monsterHealthWidth, 20, 10);

        // Define border properties
        monsterHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        monsterHealthBar.strokeRoundedRect(170, 120, monsterHealthWidth, 20, 10);
    }
    // Check if health is greater than 0 to draw the health bar
    if (currentMonsterHealth > 0) {
        updateMonsterHealth();
    }

    if(currentMonsterHealth > 0 && isAiming){
        loseMusic.play();
        disableTyping(editor, window.timerSeconds);
        currentMonsterHealth = 100;
        updateMonsterHealth();
    }else{
        winMusic.play();
        alert('You Succeeded. Tips will appear in 3 seconds.');
        currentPlayerHealth = currentPlayerHealth + 20;
        people.create(550 + (people.children.size * 50), 420, 'people').setVelocityX(100).play('crowdRun');
        updatePlayerHealthBar();
        sendPrompt(instruction, editor.getValue()).then(result => {
            delay(1000).then( () => {createAlertBox(result)}); // Show alert box only if rounds > 1
        });
    }
}


async function sendPrompt(instruction, userCode) {
    try {
        const response = await axios.post('/prompt', {
            instruction: instruction,
            userCode: userCode,
            progLanguage: language,
            type: "output",
        });
        return response.data.result;
    } catch (error) {
        console.error(error);
        return null; // or handle the error as needed
    }
}


function createAlertBox(message) {
    // Add custom styles to the head if they don't exist
    if (!document.getElementById('customAlertStyles')) {
        const style = document.createElement('style');
        style.id = 'customAlertStyles';
        style.innerHTML = `
            * {
                margin: 0;
                padding: 0;
            }
            html {
                font-family: Poppins, sans-serif;
                color: #f0f0f0;
            }
            body {
                min-height: 100vh;
                background: #0b0d15;
                color: #a2a5b3;
                align-content: center;
            }
            h1 {
                color: white;
            }
            .card {
                margin: 0;
                padding: 10px;
                width: 90%;
                background: #1c1f2b;
                text-align: center;
                border-radius: 10px;
                position: relative;
            }
            @property --angle {
                syntax: "<angle>";
                initial-value: 0deg;
                inherits: false;
            }
            .card::after, .card::before {
                content: '';
                position: absolute;
                height: 100%;
                width: 100%;
                background-image: conic-gradient(from var(--angle), transparent 10%, blue );
                top: 50%;
                left: 50%;
                translate: -50% -50%;
                z-index: -1;
                border: 10px;
                padding: 15px;
                border-radius: 10px;
                animation: 3s spin linear infinite;
            }
            .card::before {
                filter: blur(1.5rem);
                opacity: 100;
            }
            @keyframes spin {
                from {
                    --angle: 0deg;
                }
                to {
                    --angle: 360deg;
                }
            }
            .fade-out {
                opacity: 0 !important;
                transition: opacity 0.5s ease-in-out;
            }
        `;
        document.head.appendChild(style);
    }

    // Create a new alert box element
    const alertBox = document.createElement('div');
    alertBox.classList.add('card'); // Apply the card class for the animated border
    alertBox.innerHTML = `
        <div class="flex flex-col gap-2.5">
        <div class="flex bg-blue-800 rounded-b text-white px-4 py-3 alert-box m-10 pb-10">
            <div class="py-1">
                <svg class="fill-current h-10 w-10 text-white mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold">Tips to help</p>
                <p class="text-xl">${message}</p>
            </div>


        </div>

            <button type="button" onclick="removeAlertBox()" disabled class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg px-5 py-2.5 me-2 mb-2 mt-3 z-50">3</button>
        </div>
    `;

    // Append the alert box to the container
    document.getElementById('alertContainer').appendChild(alertBox);

    const button = alertBox.querySelector("button");
    let countdown = 3;

    // Start the countdown interval
    const countdownInterval = setInterval(() => {
        countdown--;
        if (countdown > 0) {
            button.textContent = countdown; // Update button text with countdown
        } else {
            clearInterval(countdownInterval); // Stop countdown
            button.textContent = "Understood"; // Set final text
            button.disabled = false; // Enable the button
        }
    }, 1000);


    // Set a timeout to remove the alert box after 7 seconds

    function removeAlertBox(){
        alertBox.classList.add('fade-out');
        setTimeout(() => 
            alertBox.remove(), 500,
            resumeTimer(), 1000); // Wait for fade-out transition
            editor.setReadOnly(false);
        // document.getElementById("startPanel").style.display = "none";
    }

    window.removeAlertBox = removeAlertBox;

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
        explosionMusic.play();
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


function setupAimingMechanic(scene) {
    // Create crosshair in the center of the screen
    crosshair = scene.add.image(500, 200, 'crosshair').setDepth(5).setVisible(false).setScale(3);

    // Tween to move the crosshair left and right
    scene.tweens.add({
        targets: crosshair,
        x: { from: 200, to: 800 }, // Adjust the movement range as needed
        duration: 1000,
        yoyo: true,
        repeat: -1,
        ease: 'Sine.easeInOut'
    });

    // Create the shoot button
    shootButton = scene.add.sprite(525, 550, 'shootButton').setInteractive().setDepth(5).setVisible(false).setScale(4);

    // Add event listener for the button click
    shootButton.on('pointerdown', function () {
        shootButton.play('shootButton');
        if (!isShooting) {
            isShooting = true;
            fireBulletAtCrosshair();
            shootMusic.play();
        }
    });
}

// Function to show the crosshair and button
function showAimingMechanic() {
    currentMonsterHealth = 100;
    updateMonsterHealthBar();
    crosshair.setVisible(true);
    shootButton.setVisible(true);
    isAiming = true;
}

// Function to hide the crosshair and button
function hideAimingMechanic() {
    crosshair.setVisible(false);
    shootButton.setVisible(false);
    shouldRegen = false;

    isAiming = false;
    currentMonsterHealth = 100;
    updateMonsterHealthBar();

}

// Modified overlap function to hide the crosshair and button on bullet hit
function hitTarget(monster, bullet) {
    bullet.destroy(); // Destroy the bullet
    reduceMonsterHealth(20); // Reduce the monster's health

    // Hide the crosshair and button
    hideAimingMechanic();
}
