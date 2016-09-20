'use strict';

var BaseDirective = require('./_base');

class ToggleDirective extends BaseDirective {

  constructor(fullscreen, $body) {
    super(fullscreen, $body);
    this.toggle = this.toggle.bind(this);
  }


  toggle() {
    this._fullscreenService.toggle();
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
        controller: ['fullscreen', '$body', ToggleDirective],
        controllerAs: 'fullScreenCtrl',
        controllerClass: ToggleDirective,
        link: function (scope, element, attributes, controller) {
          element.bind('click', controller.toggle);
        }
      }
    };
  }

}

module.exports = ToggleDirective;
