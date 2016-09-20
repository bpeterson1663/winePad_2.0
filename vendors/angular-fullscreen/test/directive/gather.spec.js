'use strict';

const GatherDirective = require('../../directive/gather');
const Service = require('../../service');
const ScreenfullMock = require('./../mocks/screenfull');
const DocumentMock = require('./../mocks/document');
const BodyMock = require('./../mocks/body');

describe('Gather Directive', function() {

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
    directive = new GatherDirective(service, $body);
    directive.fullscreenClass = fullScreenClassName;
  });

  describe('#gather', function() {

    it('should change the view to normal if fullscreen is on', function () {
      screenfull.isFullscreen = true;

      directive.gather();
      this.expect(screenfull.isFullscreen).to.eql(false);
    });


    it('should keep the view in normal if fullscreen is off', function () {
      screenfull.isFullscreen = false;

      directive.gather();
      this.expect(screenfull.isFullscreen).to.eql(false);
    });

  });

});
