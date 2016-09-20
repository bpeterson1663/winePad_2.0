'use strict';

var BaseDirective = require('./_base');

class ExpandDirective extends BaseDirective {

  constructor(fullscreen, $body) {
    super(fullscreen, $body);
    this.expand = this.expand.bind(this);
  }


  expand() {
    this._fullscreenService.expand();
    this._toggleClass();
  }


  static create() {
    return function() {
      return {
        scope: {
          fullscreenClass: '@'
        },
        restrict: 'A',
        bindToController: true,
        controller: ['fullscreen', '$body', ExpandDirective],
        controllerAs: 'fullScreenCtrl',
        controllerClass: ExpandDirective,
        link: function (scope, element, attributes, controller) {
          element.bind('click', controller.expand);
        }
      }
    };
  }

}

module.exports = ExpandDirective;
