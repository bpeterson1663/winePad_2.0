'use strict';

var sinon = require('sinon');
var chai = require('chai');
var sinonChai = require('sinon-chai');

chai.use(sinonChai);
beforeEach(function() {
  this.sandbox = sinon.sandbox.create();
  this.expect = chai.expect;
  this.sinon = sinon;
});

afterEach(function* () {
  this.sandbox.restore();
});
