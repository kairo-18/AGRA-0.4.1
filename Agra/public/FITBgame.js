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
        disableWebAudio: false,
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
var monsterGroup;
var playerIsAttacking = false;
var monsterIsAttacking = false;
var player, portal, monster;
var playerX;
var tempText, currentText;
var moveCounter = 0;
var monsterGroup;
var music, walkMusic, hitMusic, typeMusic, randomMusic;

function calculateMaxMonsterHealth(calculate) {
    currentMonsterHealth = calculate * 20;
    monsterNumber = calculate;
}

function mapGenerate(scene, counter, texture, scrollFactor, depth) {
    let x = 0;
    let totalWidth = 0;

    for (let i = 0; i < counter; i++) {
        const generator = scene.add.image(x, scene.scale.height, texture)
            .setOrigin(0, 1)
            .setScrollFactor(scrollFactor)
            .setDepth(depth);  // Set depth of the layer

        // Get the width of the texture
        const textureWidth = generator.width;
        x += textureWidth;

        // Update total width
        totalWidth += textureWidth;
    }

    return totalWidth; // Return the total width generated
}

function preload() {
    this.load.image('Layer1', '/FITBAssets2/BGLayer1.png');
    this.load.image('Layer2', '/FITBAssets2/BGLayer2.png');
    this.load.image('Layer3', '/FITBAssets2/BGLayer3.png');
    this.load.image('Layer4', '/FITBAssets2/BGLayer4.png');
    this.load.image('Layer5', '/FITBAssets2/BGLayer5.png');
    this.load.image('Layer6', '/FITBAssets2/BGLayer6.png');
    this.load.image('Layer7', '/FITBAssets2/BGLayer7.png');
    this.load.image('Layer8', '/FITBAssets2/BGLayer8.png');
    this.load.atlas('player', '/FITBAssets2/player.png', '/FITBAssets2/player.json');
    this.load.atlas('monster', '/FITBAssets2/monster.png', '/FITBAssets2/monster.json');
    this.load.atlas('portal', '/FITBAssets2/portal.png', '/FITBAssets2/portal.json');
    this.load.image('dialougeBox', '/FITBAssets2/dialogueBox.png')
    this.load.script('webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js');
    this.load.audio('bgm', [
        '/FITBAssets2/FITBbgm.mp3'
    ]);
    this.load.audio('type', [
        '/FITBAssets2/FITBtype.wav'
    ]);
}

function create() {
    scene = this; 
    music = this.sound.add('bgm', {volume: 0.5, loop: true });
    music.play();
    typeMusic = this.sound.add('type', {volume: 1});
    typeMusic.setSeek(10.5);

    this.sound.pauseOnBlur = true;

    // Example calculation for maxPlayerHealth based on monsterNumber
    maxPlayerHealth = monsterNumber * 20;
    currentPlayerHealth = maxPlayerHealth;

    var width = this.scale.width;
    var height = this.scale.height;

    this.add.image(width * 0.5, height * 0.5, 'Layer1')
        .setScrollFactor(0)
        .setDepth(0); // Background layer

    mapGenerate(this, monsterNumber, 'Layer2', 0.10, 1);
    mapGenerate(this, monsterNumber, 'Layer3', 0.15, 2);
    mapGenerate(this, monsterNumber, 'Layer4', 0.20, 3);
    mapGenerate(this, monsterNumber, 'Layer5', 0.25, 4);
    mapGenerate(this, monsterNumber, 'Layer6', 0.30, 5);
    const layer7Width = mapGenerate(this, monsterNumber + 1, 'Layer7', 1, 6);
    const layer8Width = mapGenerate(this, monsterNumber + 1, 'Layer8', 1, 7);

    // Calculate the total width for the camera bounds
    const totalWidth = Math.max(layer7Width, layer8Width);
    console.log(layer7Width, totalWidth);

    // Set camera bounds
    this.cameras.main.setBounds(0, 0, totalWidth, height);

    // Set player position in world coordinates
    player = this.physics.add.sprite(200, 850, 'player').setScale(4).setDepth(8);

    portal = this.physics.add.sprite(totalWidth - 250, 850, 'portal').setScale(3).setDepth(8);

    createAnimations(scene);

    // Fix player position on screen
    player.setScrollFactor(0);

    const add = this.add;

    WebFont.load({
        google: {
            families: ['VT323']
        },
        active: function () {
            const rectWidth = 800; // Width of the rectangle
            const rectHeight = 200; // Height of the rectangle
            const maxWidth = rectWidth - 40; // Adjusted width considering padding
            const maxHeight = rectHeight - 40; // Adjusted height considering padding

            // Create a temporary text object to measure the width and height of the text
            tempText = add.text(0, 0, 'Where am I?', { fontFamily: 'VT323', fontSize: '30px', color: '#ffffff' });

            // Calculate the maximum font size based on the rectangle dimensions
            const fontSize = Math.min(
                maxWidth / tempText.width, // Fit text width
                maxHeight / tempText.height // Fit text height
            ) * 15; // Initial font size is 30px

            // Destroy the temporary text object
            tempText.destroy();

            // Set the font size dynamically and adjust the position to center the text
            const textX = width * 0.5; // X position at the center of the screen
            const textY = 135 + (rectHeight - fontSize) * 0.5; // Y position at the center of the text box
            currentText = add.text(textX, textY, 'Where am I?', { fontFamily: 'VT323', fontSize: fontSize + 'px', color: '#ffffff' }).setOrigin(0.5).setDepth(10).setScrollFactor(0);
        },
        // Handle font loading error
        inactive: function () {
            console.error('Font loading failed.');
        }
    });

    // Create player health bar graphics
    playerHealthBar = this.add.graphics().setScrollFactor(0).setDepth(10);

    // Initial update of player health bar
    updatePlayerHealthBar();

    // Draw the dialogue box
    drawDialogueBox(scene, width * 0.5, 200);

    // Spawn the monster every 5 seconds if moveCounter is not equal to monsterNumber
    scene.time.addEvent({
        delay: 5000,
        callback: spawnMonster,
        args: [scene, width, height],
        loop: true
    });

}

function update() {
    const camera = this.cameras.main;

    // Update the camera to follow the player directly
    camera.scrollX += player.body.velocity.x * this.game.loop.delta / 100;
    camera.scrollY += player.body.velocity.y * this.game.loop.delta / 100;
}

// Drawing a dialogue Box
// Drawing a dialogue Box
function drawDialogueBox(scene, centerX, centerY) {
    // Create a Graphics object
    const graphics = scene.add.graphics();

    // Define the dimensions and position of the rectangle
    const rectWidth = 800;
    const rectHeight = 200;
    const x = centerX - rectWidth / 2;
    const y = centerY - rectHeight / 2;

    // Draw the filled rectangle (inner box) with transparency
    graphics.fillStyle(0xffffff, 0); // White fill with 0 alpha for transparency
    graphics.fillRect(x, y, rectWidth, rectHeight);

    // Draw the outer border (5-pixel size)
    graphics.lineStyle(5, 0x000000, 1); // Black border
    graphics.strokeRect(x, y, rectWidth, rectHeight);

    // Adjust the inner border offset for better visibility
    const innerBorderOffset = 10; // Reduce the offset
    const innerRectWidth = rectWidth - 2 * innerBorderOffset;
    const innerRectHeight = rectHeight - 2 * innerBorderOffset;

    // Draw the inner border
    graphics.lineStyle(1, 0xffffff, 1); // White border with 1-pixel size
    graphics.strokeRect(x + innerBorderOffset, y + innerBorderOffset, innerRectWidth, innerRectHeight);

    // Set the Graphics object to not scroll with the camera
    graphics.setScrollFactor(0);

    graphics.setDepth(10);
}


// New function to move the player 1000 pixels to the right
// New function to move the camera 1000 pixels to the right
function movePlayer(scene, onComplete) {
    moveCounter++;
    const duration = 2000; // Duration in milliseconds to move 1000 pixels

    scene.tweens.add({
        targets: scene.cameras.main,
        scrollX: scene.cameras.main.scrollX + 1000, // Scroll the camera 1000 pixels to the right
        ease: 'Linear',
        duration: duration,
        onStart: () => {
            player.play('playerRun');

            // Change text
            const randomText = ["I must find the exit", "Got to get out quick", "Is the exit near?"];
            if(moveCounter != monsterNumber){
                typeMusic.play();
                currentText.setText(Phaser.Math.RND.pick(randomText));
                
            } else {
                currentText.setText("The exit! I'm safe!");
            }

            // Stop spawning monsters if moveCounter reaches monsterNumber
            if (moveCounter == monsterNumber) {
                scene.time.removeAllEvents(); // Remove all timed events (stops the monster spawn)
            }
        },
        onComplete: () => {
            // Stop player movement animation
            player.play('playerIdle');
            console.log(scene.cameras.main.scrollX);
            // Perform onComplete callback
            if (onComplete) {
                onComplete();
            }
        }
    });

    answerEnable();
}



// Function to create player animations
function createAnimations(scene) {
    scene.anims.create({
        key: `playerIdle`,
        frames: scene.anims.generateFrameNames('player', { prefix: 'idle', end: 3, zeroPad: 2 }),
        frameRate: 4,
        repeat: -1
    });

    scene.anims.create({
        key: `playerRun`,
        frames: scene.anims.generateFrameNames('player', { prefix: 'run', end: 7, zeroPad: 2 }),
        frameRate: 8,
        repeat: -1
    });

    scene.anims.create({
        key: `playerHurt`,
        frames: scene.anims.generateFrameNames('player', { prefix: 'hurt', end: 7, zeroPad: 2 }),
        frameRate: 8,
        repeat: 0
    });

    scene.anims.create({
        key: `monsterIdle`,
        frames: scene.anims.generateFrameNames('monster', { prefix: 'idle', end: 5, zeroPad: 2 }),
        frameRate: 6,
        repeat: -1
    });

    scene.anims.create({
        key: `monsterTrap`,
        frames: scene.anims.generateFrameNames('monster', { prefix: 'trap', end: 5, zeroPad: 2 }),
        frameRate: 6,
        repeat: -1
    });

    scene.anims.create({
        key: `monsterAttack`,
        frames: scene.anims.generateFrameNames('monster', { prefix: 'attack', end: 9, zeroPad: 2 }),
        frameRate: 10,
        repeat: 0
    });

    scene.anims.create({
        key: `portalStart`,
        frames: scene.anims.generateFrameNames('portal', { prefix: 'portal', end: 5, zeroPad: 2 }),
        frameRate: 6,
        repeat: -1
    });

    player.play('playerIdle');
    portal.play('portalStart');
}

// Function for Monster hitting Player
function shakeCamera(scene) {
    scene.cameras.main.shake(500, 0.007);
    // Damage player function below
    reducePlayerHealth(20);
}

// Function for having a fade-in transition
function fadeTransition(camera, duration) {
    camera.fadeOut(duration, 0, 0, 0);
    camera.fadeIn(duration, 0, 0, 0);
}

// Function to update player health bar
function updatePlayerHealthBar() {
    playerHealthBar.clear();

    // Ensure current health is not less than 0
    playerHealthWidth = Math.max(0, 150 * (currentPlayerHealth / maxPlayerHealth));

    // Check if health is greater than 0 to draw the health bar
    if (currentPlayerHealth > 0) {
        // Fill the inner rectangle
        playerHealthBar.fillStyle(0x40D90B, 1);
        playerHealthBar.fillRoundedRect(player.x - 75, player.y + 70, playerHealthWidth, 15, 10).setDepth(10);

        // Define border properties
        playerHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        playerHealthBar.strokeRoundedRect(player.x - 75, player.y + 70, playerHealthWidth, 15, 10).setDepth(10);
    }
}

// Function to reduce player health
function reducePlayerHealth(amount) {
    currentPlayerHealth -= amount;
    currentPlayerHealth = Math.max(currentPlayerHealth, 0); // Ensure health doesn't go below 0
    updatePlayerHealthBar();
}

// Function to update monster health bar
function updateMonsterHealthBar() {
    monsterHealthBar.clear();

    // Ensure current health is not less than 0
    var numCircles = Math.ceil(currentMonsterHealth / 20); // Calculate the number of circles based on current health
    a
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

function spawnMonster(scene, width, height) {
    // Define possible layers for monster to appear
    const layers = [2, 3, 4, 5, 6, 7, 8];

    // Change text
    const randomText = ["What is that?!", "Did something move?", "This place feels eerie"];
    currentText.setText(Phaser.Math.RND.pick(randomText));

    // Randomly select two layers
    const layerIndex1 = Phaser.Math.Between(0, layers.length - 1);
    let layerIndex2;
    do {
        layerIndex2 = Phaser.Math.Between(0, layers.length - 1);
    } while (layerIndex2 === layerIndex1);

    const layer1 = layers[layerIndex1];
    const layer2 = layers[layerIndex2];

    // Determine spawn side (left or right) based on camera's left and right coordinates
    const spawnSide = Phaser.Math.Between(0, 1); // 0 for left, 1 for right
    const spawnX = spawnSide === 0 ? scene.cameras.main.scrollX - 50 : scene.cameras.main.scrollX + scene.cameras.main.width + 50; // Off-screen positions

    // Y position between 200 and 700
    const spawnY = Phaser.Math.Between(400, 700);

    // Create monster sprite
    const monster = scene.physics.add.sprite(spawnX, spawnY, 'monster').setScale(5);

    // Set transparency (reduce alpha)
    monster.setAlpha(0.5); // Set alpha to 50% transparency

    // Flip the monster sprite if it is moving from left to right
    if (spawnSide === 0) {
        monster.setFlipX(true);
    } else {
        monster.setFlipX(false);
    }

    // Determine target position (opposite side)
    const targetX = spawnSide === 0 ? scene.cameras.main.scrollX + scene.cameras.main.width + 50 : scene.cameras.main.scrollX - 50;

    // Move the monster towards the opposite side
    scene.tweens.add({
        targets: monster,
        x: targetX,
        ease: 'Linear',
        duration: 3000, // Move to the opposite side in 3 seconds
        onComplete: () => {
            // Destroy the monster sprite once it leaves the screen
            monster.destroy();
        }
    });

    // Play monster idle animation
    monster.play('monsterIdle');

    // Set monster depth to ensure it appears between the layers
    const minDepth = Math.min(layer1, layer2);
    const maxDepth = Math.max(layer1, layer2);
    monster.setDepth((minDepth + maxDepth) / 4);

    // Add the monster to the monster group
    if (!monsterGroup) {
        monsterGroup = scene.add.group();
    }
    monsterGroup.add(monster);
}

function monsterAttack(scene) {
    // Destroy all existing monsters
    if (monsterGroup) {
        monsterGroup.getChildren().forEach(monster => {
            monster.destroy();
        });
        monsterGroup.clear(true, true);
    }

    // Calculate the spawn position relative to the camera's scroll position
    const spawnX = scene.cameras.main.scrollX + player.x + 150; // Spawn 150 pixels to the right of the player
    const spawnY = player.y - 50;

    // Create the monster sprite
    const monster = scene.physics.add.sprite(spawnX, spawnY, 'monster').setScale(5);

    // Play monster attack animation
    monster.play('monsterAttack');

    // Set monster depth
    monster.setDepth(9); // Ensure the monster appears above other elements

    scene.time.delayedCall(500, function() {
        shakeCamera(scene);
        currentText.setText("Ouch!!");
    });

    // Perform fade out after the animation finishes
    monster.on('animationcomplete', () => {
        scene.tweens.add({
            targets: monster,
            alpha: 0,
            duration: 500, // Fade out duration
            onComplete: () => {
                // Destroy the monster sprite after fading out
                monster.destroy();
            }
        });
    });

    // Add the attacking monster to the group
    monsterGroup.add(monster);
}
