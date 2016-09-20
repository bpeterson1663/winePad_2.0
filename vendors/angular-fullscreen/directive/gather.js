'use strict';

class GatherDirective {

  constructor(fullscreen, $body) {
    this._$body = $body;
    this._fullscreenService = fullscreen;
    this.gather = this.gather.bind(this);
  }


  gather() {
    this._fullscreenService.gather();
  }


  static create() {
    return function() {
      return {
        scope: {},
        restrict: 'A',
        bindToController: true,
        controller: ['fullscreen', '$body', GatherDirective],
        controllerAs: 'fullScreenCtrl',
        controllerClass: GatherDirective,
        link: function (scope, element, attributes, controller) {
          element.bind('click', controller.gather);
        }
      }
    };
  }

}

module.exports = GatherDirective;
