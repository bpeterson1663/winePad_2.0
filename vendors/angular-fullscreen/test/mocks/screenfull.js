'use strict';

class ScreenfullMock {

  constructor() {
    this.isFullscreen = false;
    this.enabled = true;
  }


  get raw() {
    return { fullscreenchange: 'something' };
  }


  request() {
    this.isFullscreen = true;
  }


  exit() {
    this.isFullscreen = false;
  }


  toggle() {
    this.isFullscreen = !this.isFullscreen;
  }

}

module.exports = ScreenfullMock;
