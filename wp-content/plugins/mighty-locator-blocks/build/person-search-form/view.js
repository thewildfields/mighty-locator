/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/***/ ((module) => {

module.exports = window["wp"]["url"];

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
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*******************************************!*\
  !*** ./blocks/person-search-form/view.js ***!
  \*******************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_1__);
/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */




/* eslint-disable no-console */

const submitButton = document.getElementById('person-serch-form-submit');
const notificationTextContainer = document.querySelector('.psfWaiter__notification');
const psfWaiterLoaderContainer = document.querySelector('.psfWaiter__loaderContainer');
const resultArea = document.querySelector('.psfResult');
const notificationList = ['Searching the databases', 'Comparing different sources', 'Filtering the data', 'Removing the dublicates', 'Saving the result', 'This takes longer than expected'];
const enableWaiter = () => {
  notificationTextContainer.textContent = notificationList[0];
  psfWaiterLoaderContainer.classList.add('psfWaiter__loaderContainer_active');
};
const disableWaiter = () => {
  notificationTextContainer.textContent = '';
  psfWaiterLoaderContainer.classList.remove('psfWaiter__loaderContainer_active');
};
submitButton.addEventListener('click', function (e) {
  const form = this.closest('.psf');
  const inputs = form.querySelectorAll('.mlForm__input');
  const requiredInputs = form.querySelectorAll('.mlForm__input[required]');
  let requiredInputsHaveValues = true;
  for (let i = 0; i < requiredInputs.length; i++) {
    const val = requiredInputs[i].value.trim();
    if (!val || val == '' || val.length == 0) {
      requiredInputsHaveValues = false;
      break;
    }
  }
  if (requiredInputsHaveValues) {
    e.preventDefault();
    e.stopPropagation();
    resultArea.innerHTML = '';
    enableWaiter();
    const searchInput = {};
    inputs.forEach(input => {
      if (input.value) {
        searchInput[input.name.slice(4)] = input.value;
      }
    });
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
      path: '/ml/v2/person-search',
      method: 'POST',
      data: searchInput
    }).then(response => {
      const responseJSON = JSON.parse(response);
      const content = JSON.parse(responseJSON.content);
      resultArea.innerHTML += content;
      disableWaiter();
    });
  }
});

/* eslint-enable no-console */
})();

/******/ })()
;
//# sourceMappingURL=view.js.map