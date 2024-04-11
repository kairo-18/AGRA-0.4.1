'use strict';
/***
 ****    Phaser Plugin to Shake Camera.
 ****    shakeFrameCount is the number of frames to shake the camera - the duration
 ****    shakeAmplitude controls the magnitude of the camera displacement
 ****    shakeMode is what determines how the camera shakes. Rand will displace x and y a random amplitude up to +/- shakeAmplitude
 ****    shakeVolume determines how the shaking evolves over time.
 ***/

Phaser.Plugin.cameraShaker = function(game, parent) {
    Phaser.Plugin.call(this, game, parent);

    this.settings = {
        shakeFrameCount: 0,
        shakeAmplitude: 20,
        shakeMode: 'xandy',
        shakeVolume: 'constant',
        shakeVolFactor: 0
    };

    this.game.camera.bounds = null;
    this.shakeCamera = function() {
        if (this.settings.shakeFrameCount > 0) {
            if (this.settings.shakeMode.toLowerCase() == 'xandy') {
                if (this.settings.shakeFrameCount % 2 === 0) {
                    this.game.camera.x += this.settings.shakeAmplitude;
                    this.game.camera.y += this.settings.shakeAmplitude;
                } else {
                    this.game.camera.x -= this.settings.shakeAmplitude;
                    this.game.camera.y -= this.settings.shakeAmplitude;
                }
            }
            if (this.settings.shakeMode.toLowerCase() == 'rand') {
                var rand1 = this.game.rnd.integerInRange(-this.settings.shakeAmplitude,this.settings.shakeAmplitude);
                var rand2 = this.game.rnd.integerInRange(-this.settings.shakeAmplitude,this.settings.shakeAmplitude);
                this.game.camera.x += rand1;
                this.game.camera.y += rand2;
            }
            if (this.settings.shakeMode.toLowerCase() == 'lefttoright') {
                if (this.settings.shakeFrameCount % 2 === 0) {
                    this.game.camera.x += this.settings.shakeAmplitude;
                } else {
                    this.game.camera.x -= this.settings.shakeAmplitude;
                }
            }
            if (this.settings.shakeMode.toLowerCase() == 'uptodown') {
                if (this.settings.shakeFrameCount > 0) {
                    if (this.settings.shakeFrameCount % 2 === 0) {
                        this.game.camera.y += this.settings.shakeAmplitude;
                    } else {
                        this.game.camera.y -= this.settings.shakeAmplitude;
                    }
                }
            }
            this.settings.shakeFrameCount--;
            if (this.settings.shakeVolume.toLowerCase() == 'crescendo') {
                this.settings.shakeAmplitude += this.settings.shakeVolFactor;
            }
            if (this.settings.shakeVolume.toLowerCase() == 'diminuendo') {
                if (this.settings.shakeAmplitude > 0) {
                    this.settings.shakeAmplitude -= this.settings.shakeVolFactor;
                } else {
                    this.settings.shakeAmplitude = 0;
                }
            }
            if (this.settings.shakeFrameCount === 0) { // reset the camera
                this.game.camera.setPosition(0,0);
            }
        }
    };
};

Phaser.Plugin.cameraShaker.prototype = Object.create(Phaser.Plugin.prototype);
Phaser.Plugin.cameraShaker.prototype.constructor = Phaser.Plugin.SamplePlugin;

Phaser.Plugin.cameraShaker.prototype.setupShake = function(count) {
    this.settings.shakeFrameCount = count;
    this.settings.shakeAmplitude = arguments[1] || 20;
    this.settings.shakeMode = arguments[2] || 'xandy';
    this.settings.shakeVolume = arguments[3] || 'constant';
    this.settings.shakeVolFactor = arguments[4] || 0;
};

Phaser.Plugin.cameraShaker.prototype.update = function() {
    this.shakeCamera();
};
