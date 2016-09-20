'use strict';

var EventEmitter = require('events').EventEmitter;

class DocumentMock {

  constructor() {
    this._eventEmitter = new EventEmitter();
  }


  addEventListener(eventName, cb) {
    this._eventEmitter.on(eventName, cb);
  }


  flush(eventName) {
    this._eventEmitter.emit(eventName);
  }

}

module.exports = DocumentMock;
