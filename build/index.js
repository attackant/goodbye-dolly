/******/
(() => { // webpackBootstrap
	/******/
	"use strict";
	/******/
	var __webpack_modules__ = ({

		/***/ "./src/edit.js":
		/*!*********************!*\
		  !*** ./src/edit.js ***!
		  \*********************/
		/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

			__webpack_require__.r(__webpack_exports__);
			/* harmony export */
			__webpack_require__.d(__webpack_exports__, {
				/* harmony export */   "default": () => (/* binding */ Edit)
				/* harmony export */
			});
			/* harmony import */
			var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
			/* harmony import */
			var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
			/* harmony import */
			var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
			/* harmony import */
			var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
			/* harmony import */
			var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
			/* harmony import */
			var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
			/* harmony import */
			var _editor_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./editor.scss */ "./src/editor.scss");

			/**
			 * Retrieves the translation of text.
			 *
			 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
			 */


			/**
			 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
			 * Those files can contain any CSS code that gets applied to the editor.
			 *
			 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
			 */


			/**
			 * The edit function describes the structure of your block in the context of the
			 * editor. This represents what the editor will render when the block is used.
			 *
			 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
			 *
			 * @param {Object}   param0
			 * @param {Object}   param0.attributes
			 * @param {string}   param0.attributes.textAlign
			 * @param {Function} param0.setAttributes
			 * @return {WPElement} Element to render.
			 */
			function Edit(_ref) {
				let {
					attributes: {
						textAlign
					},
					setAttributes
				} = _ref;
				// If the text align attribute is set, apply the correct class.
				const blockProps = (0, _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)({
					className: textAlign ? 'has-text-align-' + textAlign : ''
				});
				return (0, _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0, _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.BlockControls, {
					group: "block"
				}, (0, _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.AlignmentControl, {
					value: textAlign,
					onChange: nextAlign => {
						setAttributes({
							textAlign: nextAlign
						});
					}
				})), (0, _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", blockProps, (0, _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Goodbye Dolly, how\'s it going to end?', 'goodbye-dolly')));
			}

			/***/
		}),

		/***/ "./src/index.js":
		/*!**********************!*\
		  !*** ./src/index.js ***!
		  \**********************/
		/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

			__webpack_require__.r(__webpack_exports__);
			/* harmony import */
			var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
			/* harmony import */
			var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
			/* harmony import */
			var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/style.scss");
			/* harmony import */
			var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/edit.js");
			/* harmony import */
			var _block_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./block.json */ "./src/block.json");
			/**
			 * Registers a new block provided a unique name and an object defining its behavior.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
			 */


			/**
			 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
			 * All files containing `style` keyword are bundled together. The code used
			 * gets applied both to the front of your site and to the editor.
			 *
			 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
			 */


			/**
			 * Internal dependencies
			 */


			/**
			 * Every block starts by registering a new block type definition.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
			 */
			(0, _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_3__.name, {
				/**
				 * @see ./edit.js
				 */
				edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"]
			});

			/***/
		}),

		/***/ "./src/editor.scss":
		/*!*************************!*\
		  !*** ./src/editor.scss ***!
		  \*************************/
		/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

			__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


			/***/
		}),

		/***/ "./src/style.scss":
		/*!************************!*\
		  !*** ./src/style.scss ***!
		  \************************/
		/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

			__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


			/***/
		}),

		/***/ "@wordpress/block-editor":
		/*!*************************************!*\
		  !*** external ["wp","blockEditor"] ***!
		  \*************************************/
		/***/ ((module) => {

			module.exports = window["wp"]["blockEditor"];

			/***/
		}),

		/***/ "@wordpress/blocks":
		/*!********************************!*\
		  !*** external ["wp","blocks"] ***!
		  \********************************/
		/***/ ((module) => {

			module.exports = window["wp"]["blocks"];

			/***/
		}),

		/***/ "@wordpress/element":
		/*!*********************************!*\
		  !*** external ["wp","element"] ***!
		  \*********************************/
		/***/ ((module) => {

			module.exports = window["wp"]["element"];

			/***/
		}),

		/***/ "@wordpress/i18n":
		/*!******************************!*\
		  !*** external ["wp","i18n"] ***!
		  \******************************/
		/***/ ((module) => {

			module.exports = window["wp"]["i18n"];

			/***/
		}),

		/***/ "./src/block.json":
		/*!************************!*\
		  !*** ./src/block.json ***!
		  \************************/
		/***/ ((module) => {

			module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"create-block/goodbye-dolly","version":"0.1.0","title":"Goodbye Dolly","category":"widgets","icon":"smiley","description":"Example block scaffolded with Create Block tool.","attributes":{"textAlign":{"type":"string"}},"supports":{"align":true,"color":{"background":true,"text":true},"typography":{"fontSize":true,"lineHeight":true},"__experimentalBorder":{"radius":true,"color":true,"width":true,"style":true},"html":false},"textdomain":"goodbye-dolly","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css","render":"file:./render.php"}');

			/***/
		})

		/******/
	});
	/************************************************************************/
	/******/ 	// The module cache
	/******/
	var __webpack_module_cache__ = {};
	/******/
	/******/ 	// The require function
	/******/
	function __webpack_require__(moduleId) {
		/******/ 		// Check if module is in cache
		/******/
		var cachedModule = __webpack_module_cache__[moduleId];
		/******/
		if (cachedModule !== undefined) {
			/******/
			return cachedModule.exports;
			/******/
		}
		/******/ 		// Create a new module (and put it into the cache)
		/******/
		var module = __webpack_module_cache__[moduleId] = {
			/******/ 			// no module.id needed
			/******/ 			// no module.loaded needed
			/******/            exports: {}
			/******/
		};
		/******/
		/******/ 		// Execute the module function
		/******/
		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
		/******/
		/******/ 		// Return the exports of the module
		/******/
		return module.exports;
		/******/
	}

	/******/
	/******/ 	// expose the modules object (__webpack_modules__)
	/******/
	__webpack_require__.m = __webpack_modules__;
	/******/
	/************************************************************************/
	/******/ 	/* webpack/runtime/chunk loaded */
	/******/
	(() => {
		/******/
		var deferred = [];
		/******/
		__webpack_require__.O = (result, chunkIds, fn, priority) => {
			/******/
			if (chunkIds) {
				/******/
				priority = priority || 0;
				/******/
				for (var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
				/******/
				deferred[i] = [chunkIds, fn, priority];
				/******/
				return;
				/******/
			}
			/******/
			var notFulfilled = Infinity;
			/******/
			for (var i = 0; i < deferred.length; i++) {
				/******/
				var chunkIds = deferred[i][0];
				/******/
				var fn = deferred[i][1];
				/******/
				var priority = deferred[i][2];
				/******/
				var fulfilled = true;
				/******/
				for (var j = 0; j < chunkIds.length; j++) {
					/******/
					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
						/******/
						chunkIds.splice(j--, 1);
						/******/
					} else {
						/******/
						fulfilled = false;
						/******/
						if (priority < notFulfilled) notFulfilled = priority;
						/******/
					}
					/******/
				}
				/******/
				if (fulfilled) {
					/******/
					deferred.splice(i--, 1)
					/******/
					var r = fn();
					/******/
					if (r !== undefined) result = r;
					/******/
				}
				/******/
			}
			/******/
			return result;
			/******/
		};
		/******/
	})();
	/******/
	/******/ 	/* webpack/runtime/compat get default export */
	/******/
	(() => {
		/******/ 		// getDefaultExport function for compatibility with non-harmony modules
		/******/
		__webpack_require__.n = (module) => {
			/******/
			var getter = module && module.__esModule ?
				/******/                () => (module['default']) :
				/******/                () => (module);
			/******/
			__webpack_require__.d(getter, {a: getter});
			/******/
			return getter;
			/******/
		};
		/******/
	})();
	/******/
	/******/ 	/* webpack/runtime/define property getters */
	/******/
	(() => {
		/******/ 		// define getter functions for harmony exports
		/******/
		__webpack_require__.d = (exports, definition) => {
			/******/
			for (var key in definition) {
				/******/
				if (__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
					/******/
					Object.defineProperty(exports, key, {enumerable: true, get: definition[key]});
					/******/
				}
				/******/
			}
			/******/
		};
		/******/
	})();
	/******/
	/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
	/******/
	(() => {
		/******/
		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
		/******/
	})();
	/******/
	/******/ 	/* webpack/runtime/make namespace object */
	/******/
	(() => {
		/******/ 		// define __esModule on exports
		/******/
		__webpack_require__.r = (exports) => {
			/******/
			if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
				/******/
				Object.defineProperty(exports, Symbol.toStringTag, {value: 'Module'});
				/******/
			}
			/******/
			Object.defineProperty(exports, '__esModule', {value: true});
			/******/
		};
		/******/
	})();
	/******/
	/******/ 	/* webpack/runtime/jsonp chunk loading */
	/******/
	(() => {
		/******/ 		// no baseURI
		/******/
		/******/ 		// object to store loaded and loading chunks
		/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
		/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
		/******/
		var installedChunks = {
			/******/            "index": 0,
			/******/            "./style-index": 0
			/******/
		};
		/******/
		/******/ 		// no chunk on demand loading
		/******/
		/******/ 		// no prefetching
		/******/
		/******/ 		// no preloaded
		/******/
		/******/ 		// no HMR
		/******/
		/******/ 		// no HMR manifest
		/******/
		/******/
		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
		/******/
		/******/ 		// install a JSONP callback for chunk loading
		/******/
		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
			/******/
			var chunkIds = data[0];
			/******/
			var moreModules = data[1];
			/******/
			var runtime = data[2];
			/******/ 			// add "moreModules" to the modules object,
			/******/ 			// then flag all "chunkIds" as loaded and fire callback
			/******/
			var moduleId, chunkId, i = 0;
			/******/
			if (chunkIds.some((id) => (installedChunks[id] !== 0))) {
				/******/
				for (moduleId in moreModules) {
					/******/
					if (__webpack_require__.o(moreModules, moduleId)) {
						/******/
						__webpack_require__.m[moduleId] = moreModules[moduleId];
						/******/
					}
					/******/
				}
				/******/
				if (runtime) var result = runtime(__webpack_require__);
				/******/
			}
			/******/
			if (parentChunkLoadingFunction) parentChunkLoadingFunction(data);
			/******/
			for (; i < chunkIds.length; i++) {
				/******/
				chunkId = chunkIds[i];
				/******/
				if (__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
					/******/
					installedChunks[chunkId][0]();
					/******/
				}
				/******/
				installedChunks[chunkId] = 0;
				/******/
			}
			/******/
			return __webpack_require__.O(result);
			/******/
		}
		/******/
		/******/
		var chunkLoadingGlobal = self["webpackChunkgoodbye_dolly"] = self["webpackChunkgoodbye_dolly"] || [];
		/******/
		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
		/******/
		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
		/******/
	})();
	/******/
	/************************************************************************/
	/******/
	/******/ 	// startup
	/******/ 	// Load entry module and return exports
	/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
	/******/
	var __webpack_exports__ = __webpack_require__.O(undefined, ["./style-index"], () => (__webpack_require__("./src/index.js")))
	/******/
	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
	/******/
	/******/
})()
;
//# sourceMappingURL=index.js.map
