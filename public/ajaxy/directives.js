/**
 * INSPINIA - Responsive Admin Theme
 *
 * Main directives.js file
 * Define directives for used plugin
 *
 *
 * Functions (directives)
 *  - sideNavigation
 *  - iboxTools
 *  - minimalizaSidebar
 *  - vectorMap
 *  - sparkline
 *  - icheck
 *  - ionRangeSlider
 *  - dropZone
 *  - responsiveVideo
 *  - chatSlimScroll
 *  - customValid
 *  - fullScroll
 *  - closeOffCanvas
 *  - clockPicker
 *  - landingScrollspy
 *  - fitHeight
 *  - iboxToolsFullScreen
 *  - slimScroll
 *  - truncate
 *  - touchSpin
 *  - markdownEditor
 *  - resizeable
 *
 */


/**
 * pageTitle - Directive for set Page title - mata title
 */
function pageTitle($rootScope, $timeout) {
    return {
        link: function(scope, element) {
            var listener = function(event, toState, toParams, fromState, fromParams) {
                // Default title - load on Dashboard 1
                var title = 'INSPINIA | Responsive Admin Theme';
                // Create your own title pattern
                if (toState.data && toState.data.pageTitle) title = 'INSPINIA | ' + toState.data.pageTitle;
                $timeout(function() {
                    element.text(title);
                });
            };
            $rootScope.$on('$stateChangeStart', listener);
        }
    }
};


/**
 * sideNavigation - Directive for run metsiMenu on sidebar navigation
 */
function sideNavigation($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element) {
            // Call the metsiMenu plugin and plug it to sidebar navigation
            $timeout(function(){
                $(element).metisMenu();

            });
        }
    };
};

/**
 * responsibleVideo - Directive for responsive video
 */
function responsiveVideo() {
    return {
        restrict: 'A',
        link:  function(scope, element) {
            var figure = element;
            var video = element.children();
            video
                .attr('data-aspectRatio', video.height() / video.width())
                .removeAttr('height')
                .removeAttr('width')

            //We can use $watch on $window.innerWidth also.
            $(window).resize(function() {
                var newWidth = figure.width();
                video
                    .width(newWidth)
                    .height(newWidth * video.attr('data-aspectRatio'));
            }).resize();
        }
    }
}

/**
 * `Tools - Directive for iBox tools elements in right corner of ibox
 */
function iboxTools($timeout) {
    return {
        restrict: 'A',
        scope: true,
        templateUrl: 'ajaxy/views/ibox_tools.html',
        controller: function ($scope, $element) {
            // Function for collapse ibox
            $scope.showhide = function () {
                var ibox = $element.closest('div.ibox');
                var icon = $element.find('i:first');
                var content = ibox.find('div.ibox-content');
                content.slideToggle(200);
                // Toggle icon from up to down
                icon.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
                ibox.toggleClass('').toggleClass('border-bottom');
                $timeout(function () {
                    ibox.resize();
                    ibox.find('[id^=map-]').resize();
                }, 50);
            };
                // Function for close ibox
                $scope.closebox = function () {
                    var ibox = $element.closest('div.ibox');
                    ibox.remove();
                }
        }
    };
}

/**
 * iboxTools with full screen - Directive for iBox tools elements in right corner of ibox with full screen option
 */
function iboxToolsFullScreen($timeout) {
    return {
        restrict: 'A',
        scope: true,
        templateUrl: 'views/common/ibox_tools_full_screen.html',
        controller: function ($scope, $element) {
            // Function for collapse ibox
            $scope.showhide = function () {
                var ibox = $element.closest('div.ibox');
                var icon = $element.find('i:first');
                var content = ibox.find('div.ibox-content');
                content.slideToggle(200);
                // Toggle icon from up to down
                icon.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
                ibox.toggleClass('').toggleClass('border-bottom');
                $timeout(function () {
                    ibox.resize();
                    ibox.find('[id^=map-]').resize();
                }, 50);
            };
            // Function for close ibox
            $scope.closebox = function () {
                var ibox = $element.closest('div.ibox');
                ibox.remove();
            };
            // Function for full screen
            $scope.fullscreen = function () {
                var ibox = $element.closest('div.ibox');
                var button = $element.find('i.fa-expand');
                $('body').toggleClass('fullscreen-ibox-mode');
                button.toggleClass('fa-expand').toggleClass('fa-compress');
                ibox.toggleClass('fullscreen');
                setTimeout(function() {
                    $(window).trigger('resize');
                }, 100);
            }
        }
    };
}

/**
 * minimalizaSidebar - Directive for minimalize sidebar
*/
function minimalizaSidebar($timeout) {
    return {
        restrict: 'A',
        template: '<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="" ng-click="minimalize()"><i class="fa fa-bars"></i></a>',
        controller: function ($scope, $element) {
            $scope.minimalize = function () {
                $("body").toggleClass("mini-navbar");
                if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
                    // Hide menu in order to smoothly turn on when maximize menu
                    $('#side-menu').hide();
                    // For smoothly turn on menu
                    setTimeout(
                        function () {
                            $('#side-menu').fadeIn(400);
                        }, 200);
                } else if ($('body').hasClass('fixed-sidebar')){
                    $('#side-menu').hide();
                    setTimeout(
                        function () {
                            $('#side-menu').fadeIn(400);
                        }, 100);
                } else {
                    // Remove all inline style from jquery fadeIn function to reset menu state
                    $('#side-menu').removeAttr('style');
                }
            }
        }
    };
};


function closeOffCanvas() {
    return {
        restrict: 'A',
        template: '<a class="close-canvas-menu" ng-click="closeOffCanvas()"><i class="fa fa-times"></i></a>',
        controller: function ($scope, $element) {
            $scope.closeOffCanvas = function () {
                $("body").toggleClass("mini-navbar");
            }
        }
    };
}

/**
 * vectorMap - Directive for Vector map plugin
 */
function vectorMap() {
    return {
        restrict: 'A',
        scope: {
            myMapData: '=',
        },
        link: function (scope, element, attrs) {
            var map = element.vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },
                series: {
                    regions: [
                        {
                            values: scope.myMapData,
                            scale: ["#1ab394", "#22d6b1"],
                            normalizeFunction: 'polynomial'
                        }
                    ]
                },
            });
            var destroyMap = function(){
                element.remove();
            };
            scope.$on('$destroy', function() {
                destroyMap();
            });
        }
    }
}


/**
 * sparkline - Directive for Sparkline chart
 */
function sparkline() {
    return {
        restrict: 'A',
        scope: {
            sparkData: '=',
            sparkOptions: '=',
        },
        link: function (scope, element, attrs) {
            scope.$watch(scope.sparkData, function () {
                render();
            });
            scope.$watch(scope.sparkOptions, function(){
                render();
            });
            var render = function () {
                element.sparkline(scope.sparkData, scope.sparkOptions);
            };
        }
    }
};

/**
 * icheck - Directive for custom checkbox icheck
 */
function icheck($timeout) {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, element, $attrs, ngModel) {
            return $timeout(function() {
                var value;
                value = $attrs['value'];

                $scope.$watch($attrs['ngModel'], function(newValue){
                    $(element).iCheck('update');
                })

                return $(element).iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'

                }).on('ifChanged', function(event) {
                        if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
                            $scope.$apply(function() {
                                return ngModel.$setViewValue(event.target.checked);
                            });
                        }
                        if ($(element).attr('type') === 'radio' && $attrs['ngModel']) {
                            return $scope.$apply(function() {
                                return ngModel.$setViewValue(value);
                            });
                        }
                    });
            });
        }
    };
}

/**
 * ionRangeSlider - Directive for Ion Range Slider
 */
function ionRangeSlider() {
    return {
        restrict: 'A',
        scope: {
            rangeOptions: '='
        },
        link: function (scope, elem, attrs) {
            elem.ionRangeSlider(scope.rangeOptions);
        }
    }
}

/**
 * dropZone - Directive for Drag and drop zone file upload plugin
 */
function dropZone() {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {

            var config = {
                url: 'http://localhost:8080/upload',
                maxFilesize: 100,
                paramName: "uploadfile",
                maxThumbnailFilesize: 10,
                parallelUploads: 1,
                autoProcessQueue: false
            };

            var eventHandlers = {
                'addedfile': function(file) {
                    scope.file = file;
                    if (this.files[1]!=null) {
                        this.removeFile(this.files[0]);
                    }
                    scope.$apply(function() {
                        scope.fileAdded = true;
                    });
                },

                'success': function (file, response) {
                }

            };

            dropzone = new Dropzone(element[0], config);

            angular.forEach(eventHandlers, function(handler, event) {
                dropzone.on(event, handler);
            });

            scope.processDropzone = function() {
                dropzone.processQueue();
            };

            scope.resetDropzone = function() {
                dropzone.removeAllFiles();
            }
        }
    }
}

/**
 * chatSlimScroll - Directive for slim scroll for small chat
 */
function chatSlimScroll($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element) {
            $timeout(function(){
                element.slimscroll({
                    height: '234px',
                    railOpacity: 0.4
                });
            });
        }
    };
}

/**
 * customValid - Directive for custom validation example
 */
function customValid(){
    return {
        require: 'ngModel',
        link: function(scope, ele, attrs, c) {
            scope.$watch(attrs.ngModel, function() {

                // You can call a $http method here
                // Or create custom validation

                var validText = "Inspinia";

                if(scope.extras == validText) {
                    c.$setValidity('cvalid', true);
                } else {
                    c.$setValidity('cvalid', false);
                }

            });
        }
    }
}


/**
 * fullScroll - Directive for slimScroll with 100%
 */
function fullScroll($timeout){
    return {
        restrict: 'A',
        link: function(scope, element) {
            $timeout(function(){
                $(element).slimscroll({
                    height: '100%',
                    railOpacity: 0.9
                });

            });
        }
    };
}

/**
 * slimScroll - Directive for slimScroll with custom height
 */
function slimScroll($timeout){
    return {
        restrict: 'A',
        scope: {
            boxHeight: '@'
        },
        link: function(scope, element) {
            $timeout(function(){
                element.slimscroll({
                    height: scope.boxHeight,
                    railOpacity: 0.9
                });

            });
        }
    };
}

/**
 * clockPicker - Directive for clock picker plugin
 */
function clockPicker() {
    return {
        restrict: 'A',
        link: function(scope, element) {
                element.clockpicker();
        }
    };
};


/**
 * landingScrollspy - Directive for scrollspy in landing page
 */
function landingScrollspy($timeout){
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            $(element).scrollspy({
                target: '.navbar-fixed-top',
                offset: 80
            });
        }
    }
}

/**
 * fitHeight - Directive for set height fit to window height
 */
function fitHeight(){
    return {
        restrict: 'A',
        link: function(scope, element) {
            element.css("height", $(window).height() + "px");
            element.css("min-height", $(window).height() + "px");
        }
    };
}

/**
 * truncate - Directive for truncate string
 */
function truncate($timeout){
    return {
        restrict: 'A',
        scope: {
            truncateOptions: '='
        },
        link: function(scope, element) {
            $timeout(function(){
                element.dotdotdot(scope.truncateOptions);

            });
        }
    };
}


/**
 * touchSpin - Directive for Bootstrap TouchSpin
 */
function touchSpin() {
    return {
        restrict: 'A',
        scope: {
            spinOptions: '='
        },
        link: function (scope, element, attrs) {
            scope.$watch(scope.spinOptions, function(){
                render();
            });
            var render = function () {
                $(element).TouchSpin(scope.spinOptions);
            };
        }
    }
};

/**
 * markdownEditor - Directive for Bootstrap Markdown
 */
function markdownEditor() {
    return {
        restrict: "A",
        require:  'ngModel',
        link:     function (scope, element, attrs, ngModel) {
            $(element).markdown({
                savable:false,
                onChange: function(e){
                    ngModel.$setViewValue(e.getContent());
                }
            });
        }
    }
};

function numericOnly(){
    return {
        require: '?ngModel',
        link: function(scope, element, attrs, ngModelCtrl) {
          if(!ngModelCtrl) {
            return; 
          }

          ngModelCtrl.$parsers.push(function(val) {
            if (angular.isUndefined(val)) {
                var val = '';
            }
            var clean = val.replace(/[^0-9\.]/g, '');
            var decimalCheck = clean.split('.');

            if(!angular.isUndefined(decimalCheck[1])) {
                decimalCheck[1] = decimalCheck[1].slice(0,2);
                clean =decimalCheck[0] + '.' + decimalCheck[1];
            }

            if (val !== clean) {
              ngModelCtrl.$setViewValue(clean);
              ngModelCtrl.$render();
            }
            return clean;
          });

          element.bind('keypress', function(event) {
            if(event.keyCode === 32) {
              event.preventDefault();
            }
          });
        }
       };
};

function compareWith() {
    return {
        require: 'ngModel',
        link: function(scope, elem, attrs, ngModel) {
            ngModel.$parsers.unshift(validate);
            // Force-trigger the parsing pipeline.
            scope.$watch(attrs.sameAs, function() {
                ngModel.$setViewValue(ngModel.$viewValue);
            });

            function validate(value) {
                var isValid = scope.$eval(attrs.sameAs) == value;
                ngModel.$setValidity('same-as', isValid);
                return isValid ? value : undefined;
            }
        }
    };
}

/*
Directive that compares two input Field For Which is greater
*/
 function kcInputGreaterThan () {
     return {
       restrict: "A",
       require: "ngModel",
       link: function(scope, element, attributes, ngModel) {
        ngModel.$validators.greaterThan = function(modelValue) {
           if (modelValue && scope.greaterThan) {
             return parseFloat(modelValue) >= parseFloat(scope.greaterThan);
           }
           return true;
         };
        scope.$watch(function () {
            return scope.greaterThan;
          }, function () {
            ngModel.$validate();
        }); 

       },
       scope: {
         greaterThan: '=greaterThan'
       }
    };
};

//Custom directive that creates dates fom select boxes and compares the two months to make sure the payment month is greater 
// when the years are equal to each other
 function kcInputCompareMonth () {
     return {
       restrict: "A",
       require: "ngModel",
       link: function(scope, element, attributes, ngModel) {
        ngModel.$validators.compareMonth = function(modelValue1) {
           if (modelValue1 && scope.year2 && scope.year1 && scope.compareMonth) {
                if(scope.year2 == scope.year1){
                     var d1 = new Date('"1-'+scope.compareMonth+'-'+scope.year1+'"');
                     var d2 = new Date('"1-'+modelValue1+'-'+scope.year2+'"');
                     return parseInt(d2.getMonth()) >=  parseInt(d1.getMonth()) ;
                }
           }
           return true;
         };
        scope.$watch(function () {
            return scope.compareMonth; }, function () { ngModel.$validate();
        }); 

        scope.$watch(function () {
            return scope.year1; }, function () { ngModel.$validate(); }); 

        scope.$watch(function () { 
            return scope.year2; }, function () { ngModel.$validate();
        }); 

       },
       scope: {
         compareMonth: '=compareMonth',
         year1: '=year1',
         year2: '=year2',
         month1: '=month1'
       }
    };
};

/*
* Directive that focuses cursor on the first invalid field in a form
*/

function accessibleForm(){
    return {
       restrict: "A",
       //require: "ngModel",
       link: function(scope,element){
            element.on('submit', function(){
                var invalid_elements = element[0].querySelector('.ng-invalid');
                if(invalid_elements){
                    invalid_elements.focus();
                }
            });
       }
    };
};

/* 
*    Directive That compares two password for similarity
*/
function nxEqualEx (){
    return {
        require:'ngModel',
        link: function(scope, element, attrs, model){
           if(!attrs.nxEqualEx){
                console.log('nxEqualEx expects a model as an argument');
                return;
           }
           scope.$watch(attrs.nxEqualEx, function(value){
                if(model.$viewValue !== undefined && model.$viewValue !== ""){
                    model.$setValidity('nxEqualEx', value === model.$viewValue);
                }
           });
           model.$parsers.push(function(value){
                if(value=== undefined || value===''){
                    model.$setValidity('nxEqualEx', true);
                    return value;
                }
                var isValid = value === scope.$eval(attrs.nxEqualEx);
                model.$setValidity('nxEqualEx', isValid);
                return isValid ? value : undefined;
           });
        }
    };
};

    function fileModel($parse) {
        return {
           restrict: 'A',
           link: function(scope, element, attrs) {
              var model = $parse(attrs.fileModel);
              var modelSetter = model.assign;
              element.bind('change', function(){
                 scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                 });
              });
           }
       };
    };




angular
    .module('trello')
    .directive('pageTitle', pageTitle)
    .directive('sideNavigation', sideNavigation)
    .directive('iboxTools', iboxTools)
    .directive('minimalizaSidebar', minimalizaSidebar)
    .directive('vectorMap', vectorMap)
    .directive('sparkline', sparkline)
    .directive('icheck', icheck)
    .directive('ionRangeSlider', ionRangeSlider)
    .directive('dropZone', dropZone)
    .directive('responsiveVideo', responsiveVideo)
    .directive('chatSlimScroll', chatSlimScroll)
    .directive('customValid', customValid)
    .directive('fullScroll', fullScroll)
    .directive('closeOffCanvas', closeOffCanvas)
    .directive('clockPicker', clockPicker)
    .directive('landingScrollspy', landingScrollspy)
    .directive('fitHeight', fitHeight)
    .directive('iboxToolsFullScreen', iboxToolsFullScreen)
    .directive('slimScroll', slimScroll)
    .directive('truncate', truncate)
    .directive('touchSpin', touchSpin)
    .directive('markdownEditor', markdownEditor)
    .directive('compareWith', compareWith)
    .directive('numericOnly', numericOnly)
    .directive('kcInputGreaterThan', kcInputGreaterThan)
    .directive('kcInputCompareMonth', kcInputCompareMonth)
    .directive('accessibleForm',accessibleForm)
    .directive('nxEqualEx',nxEqualEx)
    .directive('fileModel',fileModel)
     
