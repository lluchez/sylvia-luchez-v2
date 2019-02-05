'use strict'

!(function() {

	// missing prototypes
	if( !Array.prototype.includes ) {
		Array.prototype.includes = function(searchvalue) {
			return (this.indexOf(searchvalue) !== -1)
		}
	}

	// local functions
	function formatProjectPeriod(period) {
		if( !period || period.length == 0 )
			return ''
		return '(' + period.join(' - ') + ')'
	}
	function getPathFromImage(image) {
		return (typeof image === 'string') ? image : image.src
	}
	var EXCEPTION_WORDS = ['a', 'an', 'and', 'at', 'from', 'in', 'of', 'the', 'with']
	function humanizeWordFromMatch(match, sep, word, index) {
		if( index && EXCEPTION_WORDS.includes(word) )
			return match //.toLowerCase()
		else if( word.match(/^i+$/) )
			return word.toUpperCase()
		else
			return sep + word.substr(0,1).toUpperCase() + word.substr(1)
	}
	function humanizeImageName(image) {
		return image.replace(/_/g, ' ').replace(/(^| )([a-z]+)/g, humanizeWordFromMatch)
	}
	function getTitleFromImage(image) {
		if( typeof image !== 'string' )
			return image.title
		return humanizeImageName(image.replace(/( \d+)?\.(jpg|png)$/i, ''))
	}
	function defaultController() {}

	function Slider(data, base_url, back_url) {
		this.data = data
		this.base_url = base_url
		this.back_url = back_url
		this.$img = $('.image-holder img')
		this.draggable = this.$img.draggable({
			axis: 'x',
			start: function(event, ui) {
				this.sliderStartPos = ui.position.left
			}.bind(this),
			drag: function(event, ui) {
				this.sliderCurrentPos = ui.position.left
			}.bind(this),
			revert: function() {
				return ( (this.sliderAction = this.getSliderAction()) === 0 )
			}.bind(this),
			stop: function(event, ui) {
				switch( this.sliderAction ) {
					case -1: return this.showPicture(this.data.previous)
					case  1: return this.showPicture(this.data.next)
				}
			}.bind(this),
			revertDuration: 200
		})
		$(document).keydown( this.onKeyDown.bind(this) )
		$(window).resize( this.onResize.bind(this) )
		this.onResize()
	}
	Slider.prototype.getSliderAction = function() {
		var diff = this.sliderCurrentPos - this.sliderStartPos, threshold = 100, imgWidth = parseInt(this.$img.css('width'), 10)
		if( imgWidth ) threshold = imgWidth / 3
		if( Math.abs(diff) < threshold ) return 0
		if( diff < 0 && this.data.next ) return 1
		if( diff > 0 && this.data.previous ) return -1
		return 0
	}
	Slider.prototype.showPicture = function(src) {
		if( src )
			document.location.href = this.base_url + src
	}
	Slider.prototype.onKeyDown = function(event) {
		switch(event.which) {
			case 27: return (document.location.href = this.back_url) && false
			case 37: return this.showPicture(this.data.previous)
			case 39: return this.showPicture(this.data.next)
		}
	}
	Slider.prototype.onResize = function(event) {
		this.$img.css("maxHeight", $(window).height() - (60 + $('.navbar').height()))
	}
	Slider.prototype.dispose = function() {
		$(document).unbind('keydown')
		$(window).unbind('resize')
	}


	// define the module
	angular.module("myApp", ['ngRoute'])

	// routing
	.config(['$routeProvider',
		function($routeProvider) {
			$routeProvider.
				when('/home', {
					templateUrl: 'assets/views/home.html',
					controller: 'homeController'
				}).
				when('/bio', {
					templateUrl: 'assets/views/bio.html',
					controller: 'bioController'
				}).
				when('/statement', {
					templateUrl: 'assets/views/statement.html',
					controller: 'statementController'
				}).
				when('/projects', {
					templateUrl: 'assets/views/projects.html',
					controller: 'projectsController'
				}).
				when('/projects/:project_id', {
					templateUrl: 'assets/views/view-project.html',
					controller: 'viewProjectController'
				}).
				when('/projects/:project_id/:image_id', {
					templateUrl: 'assets/views/view-project-image.html',
					controller: 'viewProjectImageController'
				}).
				when('/contact', {
					templateUrl: 'assets/views/contact.html',
					controller: 'contactController'
				}).
				when('/links', {
					templateUrl: 'assets/views/links.html',
					controller: 'linksController'
				}).
				otherwise({
					redirectTo: '/home'
				})
		}
	])

	// controllers
	.controller("homeController", defaultController)
	.controller("bioController", defaultController)
	.controller("statementController", defaultController)
	.controller("projectsController", ['$scope', '$http', function ($scope, $http) {
		$http.get('?projects.json').then(function(response) {
			$scope.data = response.data
		})
		$scope.captionText = function(project) {
			return project.name + ' ' + formatProjectPeriod(project.period)
		}
	}])
	.controller("viewProjectController", ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
		$scope.id = $routeParams.project_id
		$http.get('?projects/'+$scope.id+'.json').then(function(response) {
			$scope.data = response.data
		})
		$scope.period = function() {
			if( $scope.data )
				return formatProjectPeriod($scope.data.period)
		}
		$scope.title = function(image) {
			return getTitleFromImage(image)
		}
		$scope.src = function(image) {
			return getPathFromImage(image)
		}
	}])
	.controller("viewProjectImageController", ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
		$scope.project_id = $routeParams.project_id
		$scope.image_id = $routeParams.image_id
		$scope.loading = true
		$http.get('?projects/'+$scope.project_id+'/image/'+$scope.image_id+'.json').then(function(response) {
			$scope.data = response.data
			$('<img src="{0}" />'.format(response.data.image.absolute_src)).one('load', function () {
				$scope.$apply( function() {
					$scope.loading = false
					var projectUrl = '#/projects/'+$scope.data.project.id
					$scope.slider = new Slider($scope.data, projectUrl+'/', projectUrl)
				})
			})
			$scope.$on("$destroy", function handler() {
				if( $scope.slider ) {
					$scope.slider.dispose()
					delete $scope.slider
				}
			});
		})
		$scope.isLoading = function() {
			return $scope.loading
		}
		$scope.title = function() {
			if( ! $scope.data )
				return ''
			return $scope.data.image.title ? $scope.data.image.title : getTitleFromImage($scope.data.image.relative_src)
		}
		$scope.src = function() {
			return $scope.data ? $scope.data.image.absolute_src : 'assets/images/empty.png'
		}
		$scope.srcPrev = function() {
			return $scope.data && $scope.data.previous ? '#/projects/'+$scope.data.project.id+'/'+$scope.data.previous : ''
		}
		$scope.srcNext = function() {
			return $scope.data && $scope.data.next ? '#/projects/'+$scope.data.project.id+'/'+$scope.data.next : ''
		}
	}])
	.controller("contactController", ['$scope', '$http', function ($scope, $http) {
		$('form').submit( function(event) {
			event.preventDefault()
			var form = this
			$http.post(form.action, $scope.contact).then(function(response) {
				$scope.data = response.data
			}, function(response) {
				$scope.data = {error: '{0} ({1})'.format(response.statusText, response.status)}
			})
		})
	}])
	.controller("linksController", defaultController)

})()



// DOM-ready initialization
$(document).ready( function(e) {
	$(".navbar-nav li a").click(function(event) {
		if( this.href )
			$(".navbar-collapse").collapse('hide')
	})
})
