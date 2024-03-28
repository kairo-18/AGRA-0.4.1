let monsterTween;
let playerTween;
let monster;
let monsterHealthBar, playerHealthBar;
let maxMonsterHealth = 100, maxPlayerHealth = 100;
let currentMonsterHealth = maxMonsterHealth;
let currentPlayerHealth = maxPlayerHealth;
let music;

var config = {
  type: Phaser.AUTO,
  scale: {
    mode: Phaser.Scale.EXACT_FIT,
    autoCenter: Phaser.Scale.CENTER_BOTH,
    parent: "minigame",
    width: 350,
    height: 400
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
  this.load.image('background', '/background.png');
  this.load.image('player', '/player.png');
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
  music = this.sound.add('bgm');
  music.play();

  // Add background
  this.add.image(0, 0, 'background').setOrigin(0);

  // Create monster sprite
  monster = this.add.image(265, 100, 'monster').setScale(0.75);

  // Add player sprite
  let player = this.add.image(100, 270, 'player').setScale(0.75);

  this.add.image(245, 250, 'healthPlayer').setScale(0.9);
  this.add.image(100, 50, 'healthMonster').setScale(0.75);

  // Add monster health bar graphics
  monsterHealthBar = this.add.graphics().setScale(0.5);
  updateMonsterHealthBar();

  //Add player health bar graphics
  playerHealthBar = this.add.graphics().setScale(0.5);
  updatePlayerHealthBar();

  // Create the mute button
  muteButton = this.add.image(300, 30, 'muteButton').setOrigin(0).setScale(0.15).setInteractive();

  // Function to update player health bar
  function updatePlayerHealthBar() {
    playerHealthBar.clear();

    // Ensure current health is not less than 0
    const playerHealthWidth = Math.max(0, 250 * (currentPlayerHealth / maxPlayerHealth));

    // Check if health is greater than 0 to draw the health bar
    if (currentPlayerHealth > 0) {
        // Fill the inner rectangle
        playerHealthBar.fillStyle(0x40D90B, 1);
        playerHealthBar.fillRoundedRect(400, 500, playerHealthWidth, 30, 20);

        // Define border properties
        playerHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        playerHealthBar.strokeRoundedRect(400, 500, playerHealthWidth, 30, 20);
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
        monsterHealthBar.fillRoundedRect(120, 100, monsterHealthWidth, 30, 20);

        // Define border properties
        monsterHealthBar.lineStyle(4, 0x000000, 1); // 4 is the thickness of the border, 0x000000 is the color, 1 is the alpha
        // Draw the border around the rectangle
        monsterHealthBar.strokeRoundedRect(120, 100, monsterHealthWidth, 30, 20);
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
      duration: 400,
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
};
function update() {

}
