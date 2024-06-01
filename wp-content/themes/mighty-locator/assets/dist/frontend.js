/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/frontend.ts":
/*!********************************!*\
  !*** ./assets/src/frontend.ts ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_frontend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/frontend.scss */ \"./assets/src/scss/frontend.scss\");\n/* harmony import */ var _js_mlForm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/mlForm */ \"./assets/src/js/mlForm.js\");\n/* harmony import */ var _js_mlForm__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_mlForm__WEBPACK_IMPORTED_MODULE_1__);\n\n\n\n\n//# sourceURL=webpack://drawing-game/./assets/src/frontend.ts?");

/***/ }),

/***/ "./assets/src/js/mlForm.js":
/*!*********************************!*\
  !*** ./assets/src/js/mlForm.js ***!
  \*********************************/
/***/ (() => {

eval("// Label behaviour\n\nconst mlInputs = document.querySelectorAll('.mlForm__input');\n\nconst activateLabel = ( input ) => {\n    const inputGroup = input.closest('.mlForm__inputGroup');\n    const label = inputGroup.querySelector('.mlForm__label');\n    if( label ){\n        label.classList.add('mlForm__label_active');\n    }\n}\n\nconst deactivateLabel = ( input ) => {\n    const inputGroup = input.closest('.mlForm__inputGroup');\n    const label = inputGroup.querySelector('.mlForm__label');\n    if( !input.value || input.value.length == 0 ){\n        label.classList.remove('mlForm__label_active');\n    }\n}\n\nfor (let i = 0; i < mlInputs.length; i++) {\n    if( mlInputs[i].value && mlInputs[i].value.length > 0 ){\n        activateLabel( mlInputs[i] )\n    }\n    mlInputs[i].addEventListener( 'focus' , function(){\n        activateLabel( mlInputs[i] )\n    });\n    mlInputs[i].addEventListener( 'blur' , function(){\n        deactivateLabel( mlInputs[i] )\n    });\n}\n\n//# sourceURL=webpack://drawing-game/./assets/src/js/mlForm.js?");

/***/ }),

/***/ "./assets/src/scss/frontend.scss":
/*!***************************************!*\
  !*** ./assets/src/scss/frontend.scss ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://drawing-game/./assets/src/scss/frontend.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/src/frontend.ts");
/******/ 	
/******/ })()
;