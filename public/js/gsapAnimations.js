/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/gsapAnimations.js":
/*!****************************************!*\
  !*** ./resources/js/gsapAnimations.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

gsap.registerPlugin(ScrollTrigger);
/* V1 */

var tl = gsap.timeline({
  scrollTrigger: {
    trigger: ".main-content",
    //markers: true,
    start: "top center"
  }
});
var tl2 = gsap.timeline({
  scrollTrigger: {
    trigger: ".main-content",
    //markers: true,
    start: "top 75%"
  }
});
tl.from("#row1 div", {
  y: -50,
  opacity: 0,
  stagger: 0.2,
  duration: 0.8,
  ease: "back"
});
tl2.from("#anim-h2", {
  y: -50,
  opacity: 0,
  duration: .8
});
/* .from("#row2 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })
    .from("#row3 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })
 */

/* V2 */

/* const tl = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "top center",
    }
});
const tl2 = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "100px center",
    }
});
const tl3 = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "200px center",
    }
});

tl.from("#row1 div", {y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease:"back"})
tl2.from("#row2 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })
tl3.from("#row3 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" }) */
//.fromTo("#row1", { y: 100, x: 0, opacity: 0,}, { y: 0, x: 0, opacity: 1, duration: .5,})

/* .fromTo("#row2", { y: 100, x: 0, opacity: 0, }, { y: 0, x: 0, opacity: 1, duration: .5, })
.from("#row2 div", { y: 50, stagger: 0.2 })
.fromTo("#row3", { y: 100, x: 0, opacity: 0, }, { y: 0, x: 0, opacity: 1, duration: .5, })
.from("#row3 div", { y: 50, stagger: 0.2 })
*/

/***/ }),

/***/ 2:
/*!**********************************************!*\
  !*** multi ./resources/js/gsapAnimations.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\NICO\Desktop\provaGitGruppo\Deliveboo\resources\js\gsapAnimations.js */"./resources/js/gsapAnimations.js");


/***/ })

/******/ });