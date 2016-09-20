'use strict';

const ExpandDirective = require('../../directive/expand');
const Service = require('../../service');
const ScreenfullMock = require('./../mocks/screenfull');
const DocumentMock = require('./../mocks/document');
const BodyMock = require('./../mocks/body');

describe('Expand Directive', function() {

  const fullScreenClassName = 'im-am-the-full-screen-class';
  let directive;
  let service;
  let screenfull;
  let $body;
  let document;

  beforeEach(function() {
    $body = new BodyMock();
    screenfull = new ScreenfullMock();
    document = new DocumentMock();
    service = new Service(document, screenfull);
    directive = new ExpandDirective(service, $body);
    directive.fullscreenClass = fullScreenClassName;
  });

  describe('#expand', function() {

    it('should change the view to fullscreen if fullscreen is off', function() {
      screenfull.isFullscreen = false;

      directive.expand();
      this.expect(screenfull.isFullscreen).to.eql(true);
    });


    it('should keep the view in normal if fullscreen is on', function() {
      screenfull.isFullscreen = true;

      directive.expand();
      this.expect(screenfull.isFullscreen).to.eql(true);
    });


    it('should add the fullscreen class to the body if fullscreen is off', function() {
      screenfull.isFullscreen = false;

      directive.expand();
      this.expect($body.hasClass(fullScreenClassName)).to.be.true;
    });


    it('should keep the fullscreen class in the body if fullscreen is on', function() {
      screenfull.isFullscreen = true;
      $body.addClass(fullScreenClassName);

      directive.expand();
      this.expect($body.hasClass(fullScreenClassName)).to.be.true;
    });


    it('should keep the fullscreen class if fullscreen is off and the body already has the fullscreen class', function() {
      screenfull.isFullscreen = false;
      $body.addClass(fullScreenClassName);

      directive.expand();
      this.expect($body.hasClass(fullScreenClassName)).to.be.true;
    });

  });

  describe('on fullscreen mode change', function() {

    it('should remove the class if fullscreen mode changed to off', function() {
      screenfull.isFullscreen = false;
      $body.addClass(fullScreenClassName);
      document.flush(screenfull.raw.fullscreenchange);

      this.expect($body.hasClass(fullScreenClassName)).to.be.false;
    });


    it('should not add the class if fullscreen mode changed to on', function() {
      screenfull.isFullscreen = true;
      document.flush(screenfull.raw.fullscreenchange);

      this.expect($body.hasClass(fullScreenClassName)).to.be.false;
    });

  });

});
