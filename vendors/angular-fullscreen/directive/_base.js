'use strict';

class BaseDirective {

  constructor(fullscreen, $body) {
    this._$body = $body;
    this._fullscreenService = fullscreen;
    fullscreen.on('changed', function(isInFullscreen) {
      if (!isInFullscreen) this._toggleClass();
    }.bind(this));
  }


  _toggleClass() {
    this._$body.toggleClass(this.fullscreenClass, this._fullscreenService.isInFullScreen);
  }

}

module.exports = BaseDirective;
