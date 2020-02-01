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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nError: Cannot find module 'core-js-compat/data'\nRequire stack:\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/preset-env/lib/normalize-options.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/preset-env/lib/index.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/files/plugins.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/files/index.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/index.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/laravel-mix/src/FileCollection.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/laravel-mix/src/tasks/ConcatenateFilesTask.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/laravel-mix/src/components/Combine.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/laravel-mix/src/components/ComponentFactory.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/laravel-mix/setup/webpack.config.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/webpack-cli/bin/utils/convert-argv.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/webpack-cli/bin/cli.js\n- /Users/davidbrister/Desktop/laravel/capstone/node_modules/webpack/bin/webpack.js\n    at Function.Module._resolveFilename (internal/modules/cjs/loader.js:772:15)\n    at Function.Module._load (internal/modules/cjs/loader.js:677:27)\n    at Module.require (internal/modules/cjs/loader.js:830:19)\n    at require (/Users/davidbrister/Desktop/laravel/capstone/node_modules/v8-compile-cache/v8-compile-cache.js:161:20)\n    at Object.<anonymous> (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/preset-env/lib/normalize-options.js:10:36)\n    at Module._compile (/Users/davidbrister/Desktop/laravel/capstone/node_modules/v8-compile-cache/v8-compile-cache.js:192:30)\n    at Object.Module._extensions..js (internal/modules/cjs/loader.js:947:10)\n    at Module.load (internal/modules/cjs/loader.js:790:32)\n    at Function.Module._load (internal/modules/cjs/loader.js:703:12)\n    at Module.require (internal/modules/cjs/loader.js:830:19)\n    at require (/Users/davidbrister/Desktop/laravel/capstone/node_modules/v8-compile-cache/v8-compile-cache.js:161:20)\n    at Object.<anonymous> (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/preset-env/lib/index.js:24:48)\n    at Module._compile (/Users/davidbrister/Desktop/laravel/capstone/node_modules/v8-compile-cache/v8-compile-cache.js:192:30)\n    at Object.Module._extensions..js (internal/modules/cjs/loader.js:947:10)\n    at Module.load (internal/modules/cjs/loader.js:790:32)\n    at Function.Module._load (internal/modules/cjs/loader.js:703:12)\n    at Module.require (internal/modules/cjs/loader.js:830:19)\n    at require (/Users/davidbrister/Desktop/laravel/capstone/node_modules/v8-compile-cache/v8-compile-cache.js:161:20)\n    at requireModule (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/files/plugins.js:165:12)\n    at loadPreset (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/files/plugins.js:83:17)\n    at createDescriptor (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-descriptors.js:154:9)\n    at /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-descriptors.js:109:50\n    at Array.map (<anonymous>)\n    at createDescriptors (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-descriptors.js:109:29)\n    at createPresetDescriptors (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-descriptors.js:101:10)\n    at /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-descriptors.js:58:96\n    at cachedFunction (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/caching.js:32:19)\n    at presets (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-descriptors.js:29:84)\n    at mergeChainOpts (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-chain.js:320:26)\n    at /Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-chain.js:283:7\n    at buildRootChain (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/config-chain.js:68:29)\n    at loadPrivatePartialConfig (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/partial.js:85:55)\n    at Object.loadPartialConfig (/Users/davidbrister/Desktop/laravel/capstone/node_modules/@babel/core/lib/config/partial.js:110:18)\n    at Object.<anonymous> (/Users/davidbrister/Desktop/laravel/capstone/node_modules/babel-loader/lib/index.js:144:26)\n    at Generator.next (<anonymous>)\n    at asyncGeneratorStep (/Users/davidbrister/Desktop/laravel/capstone/node_modules/babel-loader/lib/index.js:3:103)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/davidbrister/Desktop/laravel/capstone/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/davidbrister/Desktop/laravel/capstone/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });