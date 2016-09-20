'use strict';

const _ = require('lodash');

class BodyMock {

  constructor() {
    this._classes = {};
  }


  addClass(classname) {
    this._classes[classname] = true;
  }


  removeClass(classname) {
    delete this._classes[classname];
  }


  toggleClass(classname, state) {
    state ? this.addClass(classname) : this.removeClass(classname);
  }


  hasClass(classname) {
    return _.has(this._classes, classname);
  }

}

module.exports = BodyMock;
