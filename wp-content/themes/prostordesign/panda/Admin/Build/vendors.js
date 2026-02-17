//* Axios
/* axios v0.19.2 | (c) 2020 by Matt Zabriskie */
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["axios"] = factory();
	else
		root["axios"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
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
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var bind = __webpack_require__(3);
	var Axios = __webpack_require__(4);
	var mergeConfig = __webpack_require__(22);
	var defaults = __webpack_require__(10);
	
	/**
	 * Create an instance of Axios
	 *
	 * @param {Object} defaultConfig The default config for the instance
	 * @return {Axios} A new instance of Axios
	 */
	function createInstance(defaultConfig) {
	  var context = new Axios(defaultConfig);
	  var instance = bind(Axios.prototype.request, context);
	
	  // Copy axios.prototype to instance
	  utils.extend(instance, Axios.prototype, context);
	
	  // Copy context to instance
	  utils.extend(instance, context);
	
	  return instance;
	}
	
	// Create the default instance to be exported
	var axios = createInstance(defaults);
	
	// Expose Axios class to allow class inheritance
	axios.Axios = Axios;
	
	// Factory for creating new instances
	axios.create = function create(instanceConfig) {
	  return createInstance(mergeConfig(axios.defaults, instanceConfig));
	};
	
	// Expose Cancel & CancelToken
	axios.Cancel = __webpack_require__(23);
	axios.CancelToken = __webpack_require__(24);
	axios.isCancel = __webpack_require__(9);
	
	// Expose all/spread
	axios.all = function all(promises) {
	  return Promise.all(promises);
	};
	axios.spread = __webpack_require__(25);
	
	module.exports = axios;
	
	// Allow use of default import syntax in TypeScript
	module.exports.default = axios;


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var bind = __webpack_require__(3);
	
	/*global toString:true*/
	
	// utils is a library of generic helper functions non-specific to axios
	
	var toString = Object.prototype.toString;
	
	/**
	 * Determine if a value is an Array
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an Array, otherwise false
	 */
	function isArray(val) {
	  return toString.call(val) === '[object Array]';
	}
	
	/**
	 * Determine if a value is undefined
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if the value is undefined, otherwise false
	 */
	function isUndefined(val) {
	  return typeof val === 'undefined';
	}
	
	/**
	 * Determine if a value is a Buffer
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Buffer, otherwise false
	 */
	function isBuffer(val) {
	  return val !== null && !isUndefined(val) && val.constructor !== null && !isUndefined(val.constructor)
	    && typeof val.constructor.isBuffer === 'function' && val.constructor.isBuffer(val);
	}
	
	/**
	 * Determine if a value is an ArrayBuffer
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an ArrayBuffer, otherwise false
	 */
	function isArrayBuffer(val) {
	  return toString.call(val) === '[object ArrayBuffer]';
	}
	
	/**
	 * Determine if a value is a FormData
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an FormData, otherwise false
	 */
	function isFormData(val) {
	  return (typeof FormData !== 'undefined') && (val instanceof FormData);
	}
	
	/**
	 * Determine if a value is a view on an ArrayBuffer
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a view on an ArrayBuffer, otherwise false
	 */
	function isArrayBufferView(val) {
	  var result;
	  if ((typeof ArrayBuffer !== 'undefined') && (ArrayBuffer.isView)) {
	    result = ArrayBuffer.isView(val);
	  } else {
	    result = (val) && (val.buffer) && (val.buffer instanceof ArrayBuffer);
	  }
	  return result;
	}
	
	/**
	 * Determine if a value is a String
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a String, otherwise false
	 */
	function isString(val) {
	  return typeof val === 'string';
	}
	
	/**
	 * Determine if a value is a Number
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Number, otherwise false
	 */
	function isNumber(val) {
	  return typeof val === 'number';
	}
	
	/**
	 * Determine if a value is an Object
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is an Object, otherwise false
	 */
	function isObject(val) {
	  return val !== null && typeof val === 'object';
	}
	
	/**
	 * Determine if a value is a Date
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Date, otherwise false
	 */
	function isDate(val) {
	  return toString.call(val) === '[object Date]';
	}
	
	/**
	 * Determine if a value is a File
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a File, otherwise false
	 */
	function isFile(val) {
	  return toString.call(val) === '[object File]';
	}
	
	/**
	 * Determine if a value is a Blob
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Blob, otherwise false
	 */
	function isBlob(val) {
	  return toString.call(val) === '[object Blob]';
	}
	
	/**
	 * Determine if a value is a Function
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Function, otherwise false
	 */
	function isFunction(val) {
	  return toString.call(val) === '[object Function]';
	}
	
	/**
	 * Determine if a value is a Stream
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a Stream, otherwise false
	 */
	function isStream(val) {
	  return isObject(val) && isFunction(val.pipe);
	}
	
	/**
	 * Determine if a value is a URLSearchParams object
	 *
	 * @param {Object} val The value to test
	 * @returns {boolean} True if value is a URLSearchParams object, otherwise false
	 */
	function isURLSearchParams(val) {
	  return typeof URLSearchParams !== 'undefined' && val instanceof URLSearchParams;
	}
	
	/**
	 * Trim excess whitespace off the beginning and end of a string
	 *
	 * @param {String} str The String to trim
	 * @returns {String} The String freed of excess whitespace
	 */
	function trim(str) {
	  return str.replace(/^\s*/, '').replace(/\s*$/, '');
	}
	
	/**
	 * Determine if we're running in a standard browser environment
	 *
	 * This allows axios to run in a web worker, and react-native.
	 * Both environments support XMLHttpRequest, but not fully standard globals.
	 *
	 * web workers:
	 *  typeof window -> undefined
	 *  typeof document -> undefined
	 *
	 * react-native:
	 *  navigator.product -> 'ReactNative'
	 * nativescript
	 *  navigator.product -> 'NativeScript' or 'NS'
	 */
	function isStandardBrowserEnv() {
	  if (typeof navigator !== 'undefined' && (navigator.product === 'ReactNative' ||
	                                           navigator.product === 'NativeScript' ||
	                                           navigator.product === 'NS')) {
	    return false;
	  }
	  return (
	    typeof window !== 'undefined' &&
	    typeof document !== 'undefined'
	  );
	}
	
	/**
	 * Iterate over an Array or an Object invoking a function for each item.
	 *
	 * If `obj` is an Array callback will be called passing
	 * the value, index, and complete array for each item.
	 *
	 * If 'obj' is an Object callback will be called passing
	 * the value, key, and complete object for each property.
	 *
	 * @param {Object|Array} obj The object to iterate
	 * @param {Function} fn The callback to invoke for each item
	 */
	function forEach(obj, fn) {
	  // Don't bother if no value provided
	  if (obj === null || typeof obj === 'undefined') {
	    return;
	  }
	
	  // Force an array if not already something iterable
	  if (typeof obj !== 'object') {
	    /*eslint no-param-reassign:0*/
	    obj = [obj];
	  }
	
	  if (isArray(obj)) {
	    // Iterate over array values
	    for (var i = 0, l = obj.length; i < l; i++) {
	      fn.call(null, obj[i], i, obj);
	    }
	  } else {
	    // Iterate over object keys
	    for (var key in obj) {
	      if (Object.prototype.hasOwnProperty.call(obj, key)) {
	        fn.call(null, obj[key], key, obj);
	      }
	    }
	  }
	}
	
	/**
	 * Accepts varargs expecting each argument to be an object, then
	 * immutably merges the properties of each object and returns result.
	 *
	 * When multiple objects contain the same key the later object in
	 * the arguments list will take precedence.
	 *
	 * Example:
	 *
	 * ```js
	 * var result = merge({foo: 123}, {foo: 456});
	 * console.log(result.foo); // outputs 456
	 * ```
	 *
	 * @param {Object} obj1 Object to merge
	 * @returns {Object} Result of all merge properties
	 */
	function merge(/* obj1, obj2, obj3, ... */) {
	  var result = {};
	  function assignValue(val, key) {
	    if (typeof result[key] === 'object' && typeof val === 'object') {
	      result[key] = merge(result[key], val);
	    } else {
	      result[key] = val;
	    }
	  }
	
	  for (var i = 0, l = arguments.length; i < l; i++) {
	    forEach(arguments[i], assignValue);
	  }
	  return result;
	}
	
	/**
	 * Function equal to merge with the difference being that no reference
	 * to original objects is kept.
	 *
	 * @see merge
	 * @param {Object} obj1 Object to merge
	 * @returns {Object} Result of all merge properties
	 */
	function deepMerge(/* obj1, obj2, obj3, ... */) {
	  var result = {};
	  function assignValue(val, key) {
	    if (typeof result[key] === 'object' && typeof val === 'object') {
	      result[key] = deepMerge(result[key], val);
	    } else if (typeof val === 'object') {
	      result[key] = deepMerge({}, val);
	    } else {
	      result[key] = val;
	    }
	  }
	
	  for (var i = 0, l = arguments.length; i < l; i++) {
	    forEach(arguments[i], assignValue);
	  }
	  return result;
	}
	
	/**
	 * Extends object a by mutably adding to it the properties of object b.
	 *
	 * @param {Object} a The object to be extended
	 * @param {Object} b The object to copy properties from
	 * @param {Object} thisArg The object to bind function to
	 * @return {Object} The resulting value of object a
	 */
	function extend(a, b, thisArg) {
	  forEach(b, function assignValue(val, key) {
	    if (thisArg && typeof val === 'function') {
	      a[key] = bind(val, thisArg);
	    } else {
	      a[key] = val;
	    }
	  });
	  return a;
	}
	
	module.exports = {
	  isArray: isArray,
	  isArrayBuffer: isArrayBuffer,
	  isBuffer: isBuffer,
	  isFormData: isFormData,
	  isArrayBufferView: isArrayBufferView,
	  isString: isString,
	  isNumber: isNumber,
	  isObject: isObject,
	  isUndefined: isUndefined,
	  isDate: isDate,
	  isFile: isFile,
	  isBlob: isBlob,
	  isFunction: isFunction,
	  isStream: isStream,
	  isURLSearchParams: isURLSearchParams,
	  isStandardBrowserEnv: isStandardBrowserEnv,
	  forEach: forEach,
	  merge: merge,
	  deepMerge: deepMerge,
	  extend: extend,
	  trim: trim
	};


/***/ }),
/* 3 */
/***/ (function(module, exports) {

	'use strict';
	
	module.exports = function bind(fn, thisArg) {
	  return function wrap() {
	    var args = new Array(arguments.length);
	    for (var i = 0; i < args.length; i++) {
	      args[i] = arguments[i];
	    }
	    return fn.apply(thisArg, args);
	  };
	};


/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var buildURL = __webpack_require__(5);
	var InterceptorManager = __webpack_require__(6);
	var dispatchRequest = __webpack_require__(7);
	var mergeConfig = __webpack_require__(22);
	
	/**
	 * Create a new instance of Axios
	 *
	 * @param {Object} instanceConfig The default config for the instance
	 */
	function Axios(instanceConfig) {
	  this.defaults = instanceConfig;
	  this.interceptors = {
	    request: new InterceptorManager(),
	    response: new InterceptorManager()
	  };
	}
	
	/**
	 * Dispatch a request
	 *
	 * @param {Object} config The config specific for this request (merged with this.defaults)
	 */
	Axios.prototype.request = function request(config) {
	  /*eslint no-param-reassign:0*/
	  // Allow for axios('example/url'[, config]) a la fetch API
	  if (typeof config === 'string') {
	    config = arguments[1] || {};
	    config.url = arguments[0];
	  } else {
	    config = config || {};
	  }
	
	  config = mergeConfig(this.defaults, config);
	
	  // Set config.method
	  if (config.method) {
	    config.method = config.method.toLowerCase();
	  } else if (this.defaults.method) {
	    config.method = this.defaults.method.toLowerCase();
	  } else {
	    config.method = 'get';
	  }
	
	  // Hook up interceptors middleware
	  var chain = [dispatchRequest, undefined];
	  var promise = Promise.resolve(config);
	
	  this.interceptors.request.forEach(function unshiftRequestInterceptors(interceptor) {
	    chain.unshift(interceptor.fulfilled, interceptor.rejected);
	  });
	
	  this.interceptors.response.forEach(function pushResponseInterceptors(interceptor) {
	    chain.push(interceptor.fulfilled, interceptor.rejected);
	  });
	
	  while (chain.length) {
	    promise = promise.then(chain.shift(), chain.shift());
	  }
	
	  return promise;
	};
	
	Axios.prototype.getUri = function getUri(config) {
	  config = mergeConfig(this.defaults, config);
	  return buildURL(config.url, config.params, config.paramsSerializer).replace(/^\?/, '');
	};
	
	// Provide aliases for supported request methods
	utils.forEach(['delete', 'get', 'head', 'options'], function forEachMethodNoData(method) {
	  /*eslint func-names:0*/
	  Axios.prototype[method] = function(url, config) {
	    return this.request(utils.merge(config || {}, {
	      method: method,
	      url: url
	    }));
	  };
	});
	
	utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
	  /*eslint func-names:0*/
	  Axios.prototype[method] = function(url, data, config) {
	    return this.request(utils.merge(config || {}, {
	      method: method,
	      url: url,
	      data: data
	    }));
	  };
	});
	
	module.exports = Axios;


/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	function encode(val) {
	  return encodeURIComponent(val).
	    replace(/%40/gi, '@').
	    replace(/%3A/gi, ':').
	    replace(/%24/g, '$').
	    replace(/%2C/gi, ',').
	    replace(/%20/g, '+').
	    replace(/%5B/gi, '[').
	    replace(/%5D/gi, ']');
	}
	
	/**
	 * Build a URL by appending params to the end
	 *
	 * @param {string} url The base of the url (e.g., http://www.google.com)
	 * @param {object} [params] The params to be appended
	 * @returns {string} The formatted url
	 */
	module.exports = function buildURL(url, params, paramsSerializer) {
	  /*eslint no-param-reassign:0*/
	  if (!params) {
	    return url;
	  }
	
	  var serializedParams;
	  if (paramsSerializer) {
	    serializedParams = paramsSerializer(params);
	  } else if (utils.isURLSearchParams(params)) {
	    serializedParams = params.toString();
	  } else {
	    var parts = [];
	
	    utils.forEach(params, function serialize(val, key) {
	      if (val === null || typeof val === 'undefined') {
	        return;
	      }
	
	      if (utils.isArray(val)) {
	        key = key + '[]';
	      } else {
	        val = [val];
	      }
	
	      utils.forEach(val, function parseValue(v) {
	        if (utils.isDate(v)) {
	          v = v.toISOString();
	        } else if (utils.isObject(v)) {
	          v = JSON.stringify(v);
	        }
	        parts.push(encode(key) + '=' + encode(v));
	      });
	    });
	
	    serializedParams = parts.join('&');
	  }
	
	  if (serializedParams) {
	    var hashmarkIndex = url.indexOf('#');
	    if (hashmarkIndex !== -1) {
	      url = url.slice(0, hashmarkIndex);
	    }
	
	    url += (url.indexOf('?') === -1 ? '?' : '&') + serializedParams;
	  }
	
	  return url;
	};


/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	function InterceptorManager() {
	  this.handlers = [];
	}
	
	/**
	 * Add a new interceptor to the stack
	 *
	 * @param {Function} fulfilled The function to handle `then` for a `Promise`
	 * @param {Function} rejected The function to handle `reject` for a `Promise`
	 *
	 * @return {Number} An ID used to remove interceptor later
	 */
	InterceptorManager.prototype.use = function use(fulfilled, rejected) {
	  this.handlers.push({
	    fulfilled: fulfilled,
	    rejected: rejected
	  });
	  return this.handlers.length - 1;
	};
	
	/**
	 * Remove an interceptor from the stack
	 *
	 * @param {Number} id The ID that was returned by `use`
	 */
	InterceptorManager.prototype.eject = function eject(id) {
	  if (this.handlers[id]) {
	    this.handlers[id] = null;
	  }
	};
	
	/**
	 * Iterate over all the registered interceptors
	 *
	 * This method is particularly useful for skipping over any
	 * interceptors that may have become `null` calling `eject`.
	 *
	 * @param {Function} fn The function to call for each interceptor
	 */
	InterceptorManager.prototype.forEach = function forEach(fn) {
	  utils.forEach(this.handlers, function forEachHandler(h) {
	    if (h !== null) {
	      fn(h);
	    }
	  });
	};
	
	module.exports = InterceptorManager;


/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var transformData = __webpack_require__(8);
	var isCancel = __webpack_require__(9);
	var defaults = __webpack_require__(10);
	
	/**
	 * Throws a `Cancel` if cancellation has been requested.
	 */
	function throwIfCancellationRequested(config) {
	  if (config.cancelToken) {
	    config.cancelToken.throwIfRequested();
	  }
	}
	
	/**
	 * Dispatch a request to the server using the configured adapter.
	 *
	 * @param {object} config The config that is to be used for the request
	 * @returns {Promise} The Promise to be fulfilled
	 */
	module.exports = function dispatchRequest(config) {
	  throwIfCancellationRequested(config);
	
	  // Ensure headers exist
	  config.headers = config.headers || {};
	
	  // Transform request data
	  config.data = transformData(
	    config.data,
	    config.headers,
	    config.transformRequest
	  );
	
	  // Flatten headers
	  config.headers = utils.merge(
	    config.headers.common || {},
	    config.headers[config.method] || {},
	    config.headers
	  );
	
	  utils.forEach(
	    ['delete', 'get', 'head', 'post', 'put', 'patch', 'common'],
	    function cleanHeaderConfig(method) {
	      delete config.headers[method];
	    }
	  );
	
	  var adapter = config.adapter || defaults.adapter;
	
	  return adapter(config).then(function onAdapterResolution(response) {
	    throwIfCancellationRequested(config);
	
	    // Transform response data
	    response.data = transformData(
	      response.data,
	      response.headers,
	      config.transformResponse
	    );
	
	    return response;
	  }, function onAdapterRejection(reason) {
	    if (!isCancel(reason)) {
	      throwIfCancellationRequested(config);
	
	      // Transform response data
	      if (reason && reason.response) {
	        reason.response.data = transformData(
	          reason.response.data,
	          reason.response.headers,
	          config.transformResponse
	        );
	      }
	    }
	
	    return Promise.reject(reason);
	  });
	};


/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	/**
	 * Transform the data for a request or a response
	 *
	 * @param {Object|String} data The data to be transformed
	 * @param {Array} headers The headers for the request or response
	 * @param {Array|Function} fns A single function or Array of functions
	 * @returns {*} The resulting transformed data
	 */
	module.exports = function transformData(data, headers, fns) {
	  /*eslint no-param-reassign:0*/
	  utils.forEach(fns, function transform(fn) {
	    data = fn(data, headers);
	  });
	
	  return data;
	};


/***/ }),
/* 9 */
/***/ (function(module, exports) {

	'use strict';
	
	module.exports = function isCancel(value) {
	  return !!(value && value.__CANCEL__);
	};


/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var normalizeHeaderName = __webpack_require__(11);
	
	var DEFAULT_CONTENT_TYPE = {
	  'Content-Type': 'application/x-www-form-urlencoded'
	};
	
	function setContentTypeIfUnset(headers, value) {
	  if (!utils.isUndefined(headers) && utils.isUndefined(headers['Content-Type'])) {
	    headers['Content-Type'] = value;
	  }
	}
	
	function getDefaultAdapter() {
	  var adapter;
	  if (typeof XMLHttpRequest !== 'undefined') {
	    // For browsers use XHR adapter
	    adapter = __webpack_require__(12);
	  } else if (typeof process !== 'undefined' && Object.prototype.toString.call(process) === '[object process]') {
	    // For node use HTTP adapter
	    adapter = __webpack_require__(12);
	  }
	  return adapter;
	}
	
	var defaults = {
	  adapter: getDefaultAdapter(),
	
	  transformRequest: [function transformRequest(data, headers) {
	    normalizeHeaderName(headers, 'Accept');
	    normalizeHeaderName(headers, 'Content-Type');
	    if (utils.isFormData(data) ||
	      utils.isArrayBuffer(data) ||
	      utils.isBuffer(data) ||
	      utils.isStream(data) ||
	      utils.isFile(data) ||
	      utils.isBlob(data)
	    ) {
	      return data;
	    }
	    if (utils.isArrayBufferView(data)) {
	      return data.buffer;
	    }
	    if (utils.isURLSearchParams(data)) {
	      setContentTypeIfUnset(headers, 'application/x-www-form-urlencoded;charset=utf-8');
	      return data.toString();
	    }
	    if (utils.isObject(data)) {
	      setContentTypeIfUnset(headers, 'application/json;charset=utf-8');
	      return JSON.stringify(data);
	    }
	    return data;
	  }],
	
	  transformResponse: [function transformResponse(data) {
	    /*eslint no-param-reassign:0*/
	    if (typeof data === 'string') {
	      try {
	        data = JSON.parse(data);
	      } catch (e) { /* Ignore */ }
	    }
	    return data;
	  }],
	
	  /**
	   * A timeout in milliseconds to abort a request. If set to 0 (default) a
	   * timeout is not created.
	   */
	  timeout: 0,
	
	  xsrfCookieName: 'XSRF-TOKEN',
	  xsrfHeaderName: 'X-XSRF-TOKEN',
	
	  maxContentLength: -1,
	
	  validateStatus: function validateStatus(status) {
	    return status >= 200 && status < 300;
	  }
	};
	
	defaults.headers = {
	  common: {
	    'Accept': 'application/json, text/plain, */*'
	  }
	};
	
	utils.forEach(['delete', 'get', 'head'], function forEachMethodNoData(method) {
	  defaults.headers[method] = {};
	});
	
	utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
	  defaults.headers[method] = utils.merge(DEFAULT_CONTENT_TYPE);
	});
	
	module.exports = defaults;


/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	module.exports = function normalizeHeaderName(headers, normalizedName) {
	  utils.forEach(headers, function processHeader(value, name) {
	    if (name !== normalizedName && name.toUpperCase() === normalizedName.toUpperCase()) {
	      headers[normalizedName] = value;
	      delete headers[name];
	    }
	  });
	};


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	var settle = __webpack_require__(13);
	var buildURL = __webpack_require__(5);
	var buildFullPath = __webpack_require__(16);
	var parseHeaders = __webpack_require__(19);
	var isURLSameOrigin = __webpack_require__(20);
	var createError = __webpack_require__(14);
	
	module.exports = function xhrAdapter(config) {
	  return new Promise(function dispatchXhrRequest(resolve, reject) {
	    var requestData = config.data;
	    var requestHeaders = config.headers;
	
	    if (utils.isFormData(requestData)) {
	      delete requestHeaders['Content-Type']; // Let the browser set it
	    }
	
	    var request = new XMLHttpRequest();
	
	    // HTTP basic authentication
	    if (config.auth) {
	      var username = config.auth.username || '';
	      var password = config.auth.password || '';
	      requestHeaders.Authorization = 'Basic ' + btoa(username + ':' + password);
	    }
	
	    var fullPath = buildFullPath(config.baseURL, config.url);
	    request.open(config.method.toUpperCase(), buildURL(fullPath, config.params, config.paramsSerializer), true);
	
	    // Set the request timeout in MS
	    request.timeout = config.timeout;
	
	    // Listen for ready state
	    request.onreadystatechange = function handleLoad() {
	      if (!request || request.readyState !== 4) {
	        return;
	      }
	
	      // The request errored out and we didn't get a response, this will be
	      // handled by onerror instead
	      // With one exception: request that using file: protocol, most browsers
	      // will return status as 0 even though it's a successful request
	      if (request.status === 0 && !(request.responseURL && request.responseURL.indexOf('file:') === 0)) {
	        return;
	      }
	
	      // Prepare the response
	      var responseHeaders = 'getAllResponseHeaders' in request ? parseHeaders(request.getAllResponseHeaders()) : null;
	      var responseData = !config.responseType || config.responseType === 'text' ? request.responseText : request.response;
	      var response = {
	        data: responseData,
	        status: request.status,
	        statusText: request.statusText,
	        headers: responseHeaders,
	        config: config,
	        request: request
	      };
	
	      settle(resolve, reject, response);
	
	      // Clean up request
	      request = null;
	    };
	
	    // Handle browser request cancellation (as opposed to a manual cancellation)
	    request.onabort = function handleAbort() {
	      if (!request) {
	        return;
	      }
	
	      reject(createError('Request aborted', config, 'ECONNABORTED', request));
	
	      // Clean up request
	      request = null;
	    };
	
	    // Handle low level network errors
	    request.onerror = function handleError() {
	      // Real errors are hidden from us by the browser
	      // onerror should only fire if it's a network error
	      reject(createError('Network Error', config, null, request));
	
	      // Clean up request
	      request = null;
	    };
	
	    // Handle timeout
	    request.ontimeout = function handleTimeout() {
	      var timeoutErrorMessage = 'timeout of ' + config.timeout + 'ms exceeded';
	      if (config.timeoutErrorMessage) {
	        timeoutErrorMessage = config.timeoutErrorMessage;
	      }
	      reject(createError(timeoutErrorMessage, config, 'ECONNABORTED',
	        request));
	
	      // Clean up request
	      request = null;
	    };
	
	    // Add xsrf header
	    // This is only done if running in a standard browser environment.
	    // Specifically not if we're in a web worker, or react-native.
	    if (utils.isStandardBrowserEnv()) {
	      var cookies = __webpack_require__(21);
	
	      // Add xsrf header
	      var xsrfValue = (config.withCredentials || isURLSameOrigin(fullPath)) && config.xsrfCookieName ?
	        cookies.read(config.xsrfCookieName) :
	        undefined;
	
	      if (xsrfValue) {
	        requestHeaders[config.xsrfHeaderName] = xsrfValue;
	      }
	    }
	
	    // Add headers to the request
	    if ('setRequestHeader' in request) {
	      utils.forEach(requestHeaders, function setRequestHeader(val, key) {
	        if (typeof requestData === 'undefined' && key.toLowerCase() === 'content-type') {
	          // Remove Content-Type if data is undefined
	          delete requestHeaders[key];
	        } else {
	          // Otherwise add header to the request
	          request.setRequestHeader(key, val);
	        }
	      });
	    }
	
	    // Add withCredentials to request if needed
	    if (!utils.isUndefined(config.withCredentials)) {
	      request.withCredentials = !!config.withCredentials;
	    }
	
	    // Add responseType to request if needed
	    if (config.responseType) {
	      try {
	        request.responseType = config.responseType;
	      } catch (e) {
	        // Expected DOMException thrown by browsers not compatible XMLHttpRequest Level 2.
	        // But, this can be suppressed for 'json' type as it can be parsed by default 'transformResponse' function.
	        if (config.responseType !== 'json') {
	          throw e;
	        }
	      }
	    }
	
	    // Handle progress if needed
	    if (typeof config.onDownloadProgress === 'function') {
	      request.addEventListener('progress', config.onDownloadProgress);
	    }
	
	    // Not all browsers support upload events
	    if (typeof config.onUploadProgress === 'function' && request.upload) {
	      request.upload.addEventListener('progress', config.onUploadProgress);
	    }
	
	    if (config.cancelToken) {
	      // Handle cancellation
	      config.cancelToken.promise.then(function onCanceled(cancel) {
	        if (!request) {
	          return;
	        }
	
	        request.abort();
	        reject(cancel);
	        // Clean up request
	        request = null;
	      });
	    }
	
	    if (requestData === undefined) {
	      requestData = null;
	    }
	
	    // Send the request
	    request.send(requestData);
	  });
	};


/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var createError = __webpack_require__(14);
	
	/**
	 * Resolve or reject a Promise based on response status.
	 *
	 * @param {Function} resolve A function that resolves the promise.
	 * @param {Function} reject A function that rejects the promise.
	 * @param {object} response The response.
	 */
	module.exports = function settle(resolve, reject, response) {
	  var validateStatus = response.config.validateStatus;
	  if (!validateStatus || validateStatus(response.status)) {
	    resolve(response);
	  } else {
	    reject(createError(
	      'Request failed with status code ' + response.status,
	      response.config,
	      null,
	      response.request,
	      response
	    ));
	  }
	};


/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var enhanceError = __webpack_require__(15);
	
	/**
	 * Create an Error with the specified message, config, error code, request and response.
	 *
	 * @param {string} message The error message.
	 * @param {Object} config The config.
	 * @param {string} [code] The error code (for example, 'ECONNABORTED').
	 * @param {Object} [request] The request.
	 * @param {Object} [response] The response.
	 * @returns {Error} The created error.
	 */
	module.exports = function createError(message, config, code, request, response) {
	  var error = new Error(message);
	  return enhanceError(error, config, code, request, response);
	};


/***/ }),
/* 15 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Update an Error with the specified config, error code, and response.
	 *
	 * @param {Error} error The error to update.
	 * @param {Object} config The config.
	 * @param {string} [code] The error code (for example, 'ECONNABORTED').
	 * @param {Object} [request] The request.
	 * @param {Object} [response] The response.
	 * @returns {Error} The error.
	 */
	module.exports = function enhanceError(error, config, code, request, response) {
	  error.config = config;
	  if (code) {
	    error.code = code;
	  }
	
	  error.request = request;
	  error.response = response;
	  error.isAxiosError = true;
	
	  error.toJSON = function() {
	    return {
	      // Standard
	      message: this.message,
	      name: this.name,
	      // Microsoft
	      description: this.description,
	      number: this.number,
	      // Mozilla
	      fileName: this.fileName,
	      lineNumber: this.lineNumber,
	      columnNumber: this.columnNumber,
	      stack: this.stack,
	      // Axios
	      config: this.config,
	      code: this.code
	    };
	  };
	  return error;
	};


/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var isAbsoluteURL = __webpack_require__(17);
	var combineURLs = __webpack_require__(18);
	
	/**
	 * Creates a new URL by combining the baseURL with the requestedURL,
	 * only when the requestedURL is not already an absolute URL.
	 * If the requestURL is absolute, this function returns the requestedURL untouched.
	 *
	 * @param {string} baseURL The base URL
	 * @param {string} requestedURL Absolute or relative URL to combine
	 * @returns {string} The combined full path
	 */
	module.exports = function buildFullPath(baseURL, requestedURL) {
	  if (baseURL && !isAbsoluteURL(requestedURL)) {
	    return combineURLs(baseURL, requestedURL);
	  }
	  return requestedURL;
	};


/***/ }),
/* 17 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Determines whether the specified URL is absolute
	 *
	 * @param {string} url The URL to test
	 * @returns {boolean} True if the specified URL is absolute, otherwise false
	 */
	module.exports = function isAbsoluteURL(url) {
	  // A URL is considered absolute if it begins with "<scheme>://" or "//" (protocol-relative URL).
	  // RFC 3986 defines scheme name as a sequence of characters beginning with a letter and followed
	  // by any combination of letters, digits, plus, period, or hyphen.
	  return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(url);
	};


/***/ }),
/* 18 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Creates a new URL by combining the specified URLs
	 *
	 * @param {string} baseURL The base URL
	 * @param {string} relativeURL The relative URL
	 * @returns {string} The combined URL
	 */
	module.exports = function combineURLs(baseURL, relativeURL) {
	  return relativeURL
	    ? baseURL.replace(/\/+$/, '') + '/' + relativeURL.replace(/^\/+/, '')
	    : baseURL;
	};


/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	// Headers whose duplicates are ignored by node
	// c.f. https://nodejs.org/api/http.html#http_message_headers
	var ignoreDuplicateOf = [
	  'age', 'authorization', 'content-length', 'content-type', 'etag',
	  'expires', 'from', 'host', 'if-modified-since', 'if-unmodified-since',
	  'last-modified', 'location', 'max-forwards', 'proxy-authorization',
	  'referer', 'retry-after', 'user-agent'
	];
	
	/**
	 * Parse headers into an object
	 *
	 * ```
	 * Date: Wed, 27 Aug 2014 08:58:49 GMT
	 * Content-Type: application/json
	 * Connection: keep-alive
	 * Transfer-Encoding: chunked
	 * ```
	 *
	 * @param {String} headers Headers needing to be parsed
	 * @returns {Object} Headers parsed into an object
	 */
	module.exports = function parseHeaders(headers) {
	  var parsed = {};
	  var key;
	  var val;
	  var i;
	
	  if (!headers) { return parsed; }
	
	  utils.forEach(headers.split('\n'), function parser(line) {
	    i = line.indexOf(':');
	    key = utils.trim(line.substr(0, i)).toLowerCase();
	    val = utils.trim(line.substr(i + 1));
	
	    if (key) {
	      if (parsed[key] && ignoreDuplicateOf.indexOf(key) >= 0) {
	        return;
	      }
	      if (key === 'set-cookie') {
	        parsed[key] = (parsed[key] ? parsed[key] : []).concat([val]);
	      } else {
	        parsed[key] = parsed[key] ? parsed[key] + ', ' + val : val;
	      }
	    }
	  });
	
	  return parsed;
	};


/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	module.exports = (
	  utils.isStandardBrowserEnv() ?
	
	  // Standard browser envs have full support of the APIs needed to test
	  // whether the request URL is of the same origin as current location.
	    (function standardBrowserEnv() {
	      var msie = /(msie|trident)/i.test(navigator.userAgent);
	      var urlParsingNode = document.createElement('a');
	      var originURL;
	
	      /**
	    * Parse a URL to discover it's components
	    *
	    * @param {String} url The URL to be parsed
	    * @returns {Object}
	    */
	      function resolveURL(url) {
	        var href = url;
	
	        if (msie) {
	        // IE needs attribute set twice to normalize properties
	          urlParsingNode.setAttribute('href', href);
	          href = urlParsingNode.href;
	        }
	
	        urlParsingNode.setAttribute('href', href);
	
	        // urlParsingNode provides the UrlUtils interface - http://url.spec.whatwg.org/#urlutils
	        return {
	          href: urlParsingNode.href,
	          protocol: urlParsingNode.protocol ? urlParsingNode.protocol.replace(/:$/, '') : '',
	          host: urlParsingNode.host,
	          search: urlParsingNode.search ? urlParsingNode.search.replace(/^\?/, '') : '',
	          hash: urlParsingNode.hash ? urlParsingNode.hash.replace(/^#/, '') : '',
	          hostname: urlParsingNode.hostname,
	          port: urlParsingNode.port,
	          pathname: (urlParsingNode.pathname.charAt(0) === '/') ?
	            urlParsingNode.pathname :
	            '/' + urlParsingNode.pathname
	        };
	      }
	
	      originURL = resolveURL(window.location.href);
	
	      /**
	    * Determine if a URL shares the same origin as the current location
	    *
	    * @param {String} requestURL The URL to test
	    * @returns {boolean} True if URL shares the same origin, otherwise false
	    */
	      return function isURLSameOrigin(requestURL) {
	        var parsed = (utils.isString(requestURL)) ? resolveURL(requestURL) : requestURL;
	        return (parsed.protocol === originURL.protocol &&
	            parsed.host === originURL.host);
	      };
	    })() :
	
	  // Non standard browser envs (web workers, react-native) lack needed support.
	    (function nonStandardBrowserEnv() {
	      return function isURLSameOrigin() {
	        return true;
	      };
	    })()
	);


/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	module.exports = (
	  utils.isStandardBrowserEnv() ?
	
	  // Standard browser envs support document.cookie
	    (function standardBrowserEnv() {
	      return {
	        write: function write(name, value, expires, path, domain, secure) {
	          var cookie = [];
	          cookie.push(name + '=' + encodeURIComponent(value));
	
	          if (utils.isNumber(expires)) {
	            cookie.push('expires=' + new Date(expires).toGMTString());
	          }
	
	          if (utils.isString(path)) {
	            cookie.push('path=' + path);
	          }
	
	          if (utils.isString(domain)) {
	            cookie.push('domain=' + domain);
	          }
	
	          if (secure === true) {
	            cookie.push('secure');
	          }
	
	          document.cookie = cookie.join('; ');
	        },
	
	        read: function read(name) {
	          var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
	          return (match ? decodeURIComponent(match[3]) : null);
	        },
	
	        remove: function remove(name) {
	          this.write(name, '', Date.now() - 86400000);
	        }
	      };
	    })() :
	
	  // Non standard browser env (web workers, react-native) lack needed support.
	    (function nonStandardBrowserEnv() {
	      return {
	        write: function write() {},
	        read: function read() { return null; },
	        remove: function remove() {}
	      };
	    })()
	);


/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var utils = __webpack_require__(2);
	
	/**
	 * Config-specific merge-function which creates a new config-object
	 * by merging two configuration objects together.
	 *
	 * @param {Object} config1
	 * @param {Object} config2
	 * @returns {Object} New object resulting from merging config2 to config1
	 */
	module.exports = function mergeConfig(config1, config2) {
	  // eslint-disable-next-line no-param-reassign
	  config2 = config2 || {};
	  var config = {};
	
	  var valueFromConfig2Keys = ['url', 'method', 'params', 'data'];
	  var mergeDeepPropertiesKeys = ['headers', 'auth', 'proxy'];
	  var defaultToConfig2Keys = [
	    'baseURL', 'url', 'transformRequest', 'transformResponse', 'paramsSerializer',
	    'timeout', 'withCredentials', 'adapter', 'responseType', 'xsrfCookieName',
	    'xsrfHeaderName', 'onUploadProgress', 'onDownloadProgress',
	    'maxContentLength', 'validateStatus', 'maxRedirects', 'httpAgent',
	    'httpsAgent', 'cancelToken', 'socketPath'
	  ];
	
	  utils.forEach(valueFromConfig2Keys, function valueFromConfig2(prop) {
	    if (typeof config2[prop] !== 'undefined') {
	      config[prop] = config2[prop];
	    }
	  });
	
	  utils.forEach(mergeDeepPropertiesKeys, function mergeDeepProperties(prop) {
	    if (utils.isObject(config2[prop])) {
	      config[prop] = utils.deepMerge(config1[prop], config2[prop]);
	    } else if (typeof config2[prop] !== 'undefined') {
	      config[prop] = config2[prop];
	    } else if (utils.isObject(config1[prop])) {
	      config[prop] = utils.deepMerge(config1[prop]);
	    } else if (typeof config1[prop] !== 'undefined') {
	      config[prop] = config1[prop];
	    }
	  });
	
	  utils.forEach(defaultToConfig2Keys, function defaultToConfig2(prop) {
	    if (typeof config2[prop] !== 'undefined') {
	      config[prop] = config2[prop];
	    } else if (typeof config1[prop] !== 'undefined') {
	      config[prop] = config1[prop];
	    }
	  });
	
	  var axiosKeys = valueFromConfig2Keys
	    .concat(mergeDeepPropertiesKeys)
	    .concat(defaultToConfig2Keys);
	
	  var otherKeys = Object
	    .keys(config2)
	    .filter(function filterAxiosKeys(key) {
	      return axiosKeys.indexOf(key) === -1;
	    });
	
	  utils.forEach(otherKeys, function otherKeysDefaultToConfig2(prop) {
	    if (typeof config2[prop] !== 'undefined') {
	      config[prop] = config2[prop];
	    } else if (typeof config1[prop] !== 'undefined') {
	      config[prop] = config1[prop];
	    }
	  });
	
	  return config;
	};


/***/ }),
/* 23 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * A `Cancel` is an object that is thrown when an operation is canceled.
	 *
	 * @class
	 * @param {string=} message The message.
	 */
	function Cancel(message) {
	  this.message = message;
	}
	
	Cancel.prototype.toString = function toString() {
	  return 'Cancel' + (this.message ? ': ' + this.message : '');
	};
	
	Cancel.prototype.__CANCEL__ = true;
	
	module.exports = Cancel;


/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var Cancel = __webpack_require__(23);
	
	/**
	 * A `CancelToken` is an object that can be used to request cancellation of an operation.
	 *
	 * @class
	 * @param {Function} executor The executor function.
	 */
	function CancelToken(executor) {
	  if (typeof executor !== 'function') {
	    throw new TypeError('executor must be a function.');
	  }
	
	  var resolvePromise;
	  this.promise = new Promise(function promiseExecutor(resolve) {
	    resolvePromise = resolve;
	  });
	
	  var token = this;
	  executor(function cancel(message) {
	    if (token.reason) {
	      // Cancellation has already been requested
	      return;
	    }
	
	    token.reason = new Cancel(message);
	    resolvePromise(token.reason);
	  });
	}
	
	/**
	 * Throws a `Cancel` if cancellation has been requested.
	 */
	CancelToken.prototype.throwIfRequested = function throwIfRequested() {
	  if (this.reason) {
	    throw this.reason;
	  }
	};
	
	/**
	 * Returns an object that contains a new `CancelToken` and a function that, when called,
	 * cancels the `CancelToken`.
	 */
	CancelToken.source = function source() {
	  var cancel;
	  var token = new CancelToken(function executor(c) {
	    cancel = c;
	  });
	  return {
	    token: token,
	    cancel: cancel
	  };
	};
	
	module.exports = CancelToken;


/***/ }),
/* 25 */
/***/ (function(module, exports) {

	'use strict';
	
	/**
	 * Syntactic sugar for invoking a function and expanding an array for arguments.
	 *
	 * Common use case would be to use `Function.prototype.apply`.
	 *
	 *  ```js
	 *  function f(x, y, z) {}
	 *  var args = [1, 2, 3];
	 *  f.apply(null, args);
	 *  ```
	 *
	 * With `spread` this example can be re-written.
	 *
	 *  ```js
	 *  spread(function(x, y, z) {})([1, 2, 3]);
	 *  ```
	 *
	 * @param {Function} callback
	 * @returns {Function}
	 */
	module.exports = function spread(callback) {
	  return function wrap(arr) {
	    return callback.apply(null, arr);
	  };
	};


/***/ })
/******/ ])
});
;
//# sourceMappingURL=axios.map

//* Vue

//* Sortable

//* Selectr
/*
 Selectr 2.4.13
 http://mobius.ovh/docs/selectr

 Released under the MIT license
*/
(function(g,k){"function"===typeof define&&define.amd?define([],k):"object"===typeof exports?module.exports=k("Selectr"):g.Selectr=k("Selectr")})(this,function(g){function k(a,c){return a.hasOwnProperty(c)&&(!0===a[c]||a[c].length)}function n(a,c,e){a.parentNode?a.parentNode.parentNode||c.appendChild(a.parentNode):c.appendChild(a);b.removeClass(a,"excluded");e||(a.innerHTML=a.textContent)}var l=function(){};l.prototype={on:function(a,c){this._events=this._events||{};this._events[a]=this._events[a]||
[];this._events[a].push(c)},off:function(a,c){this._events=this._events||{};!1!==a in this._events&&this._events[a].splice(this._events[a].indexOf(c),1)},emit:function(a){this._events=this._events||{};if(!1!==a in this._events)for(var c=0;c<this._events[a].length;c++)this._events[a][c].apply(this,Array.prototype.slice.call(arguments,1))}};l.mixin=function(a){for(var c=["on","off","emit"],b=0;b<c.length;b++)"function"===typeof a?a.prototype[c[b]]=l.prototype[c[b]]:a[c[b]]=l.prototype[c[b]];return a};
var b={extend:function(a,c){for(var e in c)if(c.hasOwnProperty(e)){var d=c[e];d&&"[object Object]"===Object.prototype.toString.call(d)?(a[e]=a[e]||{},b.extend(a[e],d)):a[e]=d}return a},each:function(a,c,b){if("[object Object]"===Object.prototype.toString.call(a))for(var d in a)Object.prototype.hasOwnProperty.call(a,d)&&c.call(b,d,a[d],a);else{d=0;for(var e=a.length;d<e;d++)c.call(b,d,a[d],a)}},createElement:function(a,c){var b=document,d=b.createElement(a);if(c&&"[object Object]"===Object.prototype.toString.call(c))for(var f in c)if(f in
d)d[f]=c[f];else if("html"===f)d.innerHTML=c[f];else if("text"===f){var h=b.createTextNode(c[f]);d.appendChild(h)}else d.setAttribute(f,c[f]);return d},hasClass:function(a,b){if(a)return a.classList?a.classList.contains(b):!!a.className&&!!a.className.match(new RegExp("(\\s|^)"+b+"(\\s|$)"))},addClass:function(a,c){b.hasClass(a,c)||(a.classList?a.classList.add(c):a.className=a.className.trim()+" "+c)},removeClass:function(a,c){b.hasClass(a,c)&&(a.classList?a.classList.remove(c):a.className=a.className.replace(new RegExp("(^|\\s)"+
c.split(" ").join("|")+"(\\s|$)","gi")," "))},closest:function(a,c){return a&&a!==document.body&&(c(a)?a:b.closest(a.parentNode,c))},isInt:function(a){return"number"===typeof a&&isFinite(a)&&Math.floor(a)===a},debounce:function(a,b,e){var d;return function(){var c=this,h=arguments,g=e&&!d;clearTimeout(d);d=setTimeout(function(){d=null;e||a.apply(c,h)},b);g&&a.apply(c,h)}},rect:function(a,b){var c=window,d=a.getBoundingClientRect(),f=b?c.pageXOffset:0;c=b?c.pageYOffset:0;return{bottom:d.bottom+c,height:d.height,
left:d.left+f,right:d.right+f,top:d.top+c,width:d.width}},includes:function(a,b){return-1<a.indexOf(b)},startsWith:function(a,b){return a.substr(0,b.length)===b},truncate:function(a){for(;a.firstChild;)a.removeChild(a.firstChild)}},p=function(){if(this.items.length){var a=document.createDocumentFragment();if(this.config.pagination){var c=this.pages.slice(0,this.pageIndex);b.each(c,function(c,d){b.each(d,function(d,b){n(b,a,this.customOption)},this)},this)}else b.each(this.items,function(b,d){n(d,
a,this.customOption)},this);a.childElementCount&&(b.removeClass(this.items[this.navIndex],"active"),this.navIndex=(a.querySelector(".selectr-option.selected")||a.querySelector(".selectr-option")).idx,b.addClass(this.items[this.navIndex],"active"));this.tree.appendChild(a)}},t=function(a){this.container.contains(a.target)||!this.opened&&!b.hasClass(this.container,"notice")||this.close()},m=function(a,c){var e=this.customOption?this.config.renderOption(c||a):a.textContent;e=b.createElement("li",{"class":"selectr-option",
html:e,role:"treeitem","aria-selected":!1});e.idx=a.idx;this.items.push(e);a.defaultSelected&&this.defaultSelected.push(a.idx);a.disabled&&(e.disabled=!0,b.addClass(e,"disabled"));return e},u=function(){this.requiresPagination=this.config.pagination&&0<this.config.pagination;k(this.config,"width")&&(b.isInt(this.config.width)?this.width=this.config.width+"px":"auto"===this.config.width?this.width="100%":b.includes(this.config.width,"%")&&(this.width=this.config.width));this.container=b.createElement("div",
{"class":"selectr-container"});this.config.customClass&&b.addClass(this.container,this.config.customClass);this.mobileDevice?b.addClass(this.container,"selectr-mobile"):b.addClass(this.container,"selectr-desktop");this.el.tabIndex=-1;this.config.nativeDropdown||this.mobileDevice?b.addClass(this.el,"selectr-visible"):b.addClass(this.el,"selectr-hidden");this.selected=b.createElement("div",{"class":"selectr-selected",disabled:this.disabled,tabIndex:0,"aria-expanded":!1});this.label=b.createElement(this.el.multiple?
"ul":"span",{"class":"selectr-label"});var a=b.createElement("div",{"class":"selectr-options-container"});this.tree=b.createElement("ul",{"class":"selectr-options",role:"tree","aria-hidden":!0,"aria-expanded":!1});this.notice=b.createElement("div",{"class":"selectr-notice"});this.el.setAttribute("aria-hidden",!0);this.disabled&&(this.el.disabled=!0);this.el.multiple&&(b.addClass(this.label,"selectr-tags"),b.addClass(this.container,"multiple"),this.tags=[],this.selectedValues=this.getSelectedProperties("value"),
this.selectedIndexes=this.getSelectedProperties("idx"));this.selected.appendChild(this.label);this.config.clearable&&(this.selectClear=b.createElement("button",{"class":"selectr-clear",type:"button"}),this.container.appendChild(this.selectClear),b.addClass(this.container,"clearable"));if(this.config.taggable){var c=b.createElement("li",{"class":"input-tag"});this.input=b.createElement("input",{"class":"selectr-tag-input",placeholder:this.config.tagPlaceholder,tagIndex:0,autocomplete:"off",autocorrect:"off",
autocapitalize:"off",spellcheck:"false",role:"textbox",type:"search"});c.appendChild(this.input);this.label.appendChild(c);b.addClass(this.container,"taggable");this.tagSeperators=[","];this.config.tagSeperators&&(this.tagSeperators=this.tagSeperators.concat(this.config.tagSeperators))}this.config.searchable&&(this.input=b.createElement("input",{"class":"selectr-input",tagIndex:-1,autocomplete:"off",autocorrect:"off",autocapitalize:"off",spellcheck:"false",role:"textbox",type:"search"}),this.inputClear=
b.createElement("button",{"class":"selectr-input-clear",type:"button"}),this.inputContainer=b.createElement("div",{"class":"selectr-input-container"}),this.inputContainer.appendChild(this.input),this.inputContainer.appendChild(this.inputClear),a.appendChild(this.inputContainer));a.appendChild(this.notice);a.appendChild(this.tree);this.items=[];this.options=[];this.el.options.length&&(this.options=[].slice.call(this.el.options));var e=!1,d=0;this.el.children.length&&b.each(this.el.children,function(a,
c){"OPTGROUP"===c.nodeName?(e=b.createElement("ul",{"class":"selectr-optgroup",role:"group",html:"<li class='selectr-optgroup--label'>"+c.label+"</li>"}),b.each(c.children,function(a,b){b.idx=d;e.appendChild(m.call(this,b,e));d++},this)):(c.idx=d,m.call(this,c),d++)},this);if(this.config.data&&Array.isArray(this.config.data)){this.data=[];var f=!1,h;e=!1;d=0;b.each(this.config.data,function(a,c){k(c,"children")?(f=b.createElement("optgroup",{label:c.text}),e=b.createElement("ul",{"class":"selectr-optgroup",
role:"group",html:"<li class='selectr-optgroup--label'>"+c.text+"</li>"}),b.each(c.children,function(a,b){h=new Option(b.text,b.value,!1,b.hasOwnProperty("selected")&&!0===b.selected);h.disabled=k(b,"disabled");this.options.push(h);f.appendChild(h);h.idx=d;e.appendChild(m.call(this,h,b));this.data[d]=b;d++},this),this.el.appendChild(f)):(h=new Option(c.text,c.value,!1,c.hasOwnProperty("selected")&&!0===c.selected),h.disabled=k(c,"disabled"),this.options.push(h),h.idx=d,m.call(this,h,c),this.data[d]=
c,d++)},this)}this.setSelected(!0);for(var g=this.navIndex=0;g<this.items.length;g++)if(c=this.items[g],!b.hasClass(c,"disabled")){b.addClass(c,"active");this.navIndex=g;break}this.requiresPagination&&(this.pageIndex=1,this.paginate());this.container.appendChild(this.selected);this.container.appendChild(a);this.placeEl=b.createElement("div",{"class":"selectr-placeholder"});this.setPlaceholder();this.selected.appendChild(this.placeEl);this.disabled&&this.disable();this.el.parentNode.insertBefore(this.container,
this.el);this.container.appendChild(this.el)},v=function(a){a=a||window.event;if(this.items.length&&this.opened&&b.includes([13,38,40],a.which)){a.preventDefault();if(13===a.which)return this.noResults||this.config.taggable&&0<this.input.value.length?!1:this.change(this.navIndex);var c=this.items[this.navIndex],e=this.navIndex;switch(a.which){case 38:var d=0;0<this.navIndex&&this.navIndex--;break;case 40:d=1,this.navIndex<this.items.length-1&&this.navIndex++}for(this.navigating=!0;b.hasClass(this.items[this.navIndex],
"disabled")||b.hasClass(this.items[this.navIndex],"excluded");){if(0<this.navIndex&&this.navIndex<this.items.length-1)d?this.navIndex++:this.navIndex--;else{this.navIndex=e;break}if(this.searching)if(this.navIndex>this.tree.lastElementChild.idx){this.navIndex=this.tree.lastElementChild.idx;break}else if(this.navIndex<this.tree.firstElementChild.idx){this.navIndex=this.tree.firstElementChild.idx;break}}a=b.rect(this.items[this.navIndex]);d?(0===this.navIndex?this.tree.scrollTop=0:a.top+a.height>this.optsRect.top+
this.optsRect.height&&(this.tree.scrollTop+=a.top+a.height-(this.optsRect.top+this.optsRect.height)),this.navIndex===this.tree.childElementCount-1&&this.requiresPagination&&r.call(this)):0===this.navIndex?this.tree.scrollTop=0:0>a.top-this.optsRect.top&&(this.tree.scrollTop+=a.top-this.optsRect.top);c&&b.removeClass(c,"active");b.addClass(this.items[this.navIndex],"active")}else this.navigating=!1},w=function(a){var c=this,e=document.createDocumentFragment(),d=this.options[a.idx],f=this.data?this.data[a.idx]:
d;f=this.customSelected?this.config.renderSelection(f):d.textContent;f=b.createElement("li",{"class":"selectr-tag",html:f});var h=b.createElement("button",{"class":"selectr-tag-remove",type:"button"});f.appendChild(h);f.idx=a.idx;f.tag=d.value;this.tags.push(f);if(this.config.sortSelected){a=this.tags.slice();var g=function(a,b){a.replace(/(\d+)|(\D+)/g,function(a,d,c){b.push([d||Infinity,c||""])})};a.sort(function(a,b){var d=[],e=[];if(!0===c.config.sortSelected){var f=a.tag;var h=b.tag}else"text"===
c.config.sortSelected&&(f=a.textContent,h=b.textContent);g(f,d);for(g(h,e);d.length&&e.length;)if(f=d.shift(),h=e.shift(),f=f[0]-h[0]||f[1].localeCompare(h[1]))return f;return d.length-e.length});b.each(a,function(a,b){e.appendChild(b)});this.label.innerHTML=""}else e.appendChild(f);this.config.taggable?this.label.insertBefore(e,this.input.parentNode):this.label.appendChild(e)},x=function(a){var c=!1;b.each(this.tags,function(b,d){d.idx===a.idx&&(c=d)},this);c&&(this.label.removeChild(c),this.tags.splice(this.tags.indexOf(c),
1))},r=function(){var a=this.tree;if(a.scrollTop>=a.scrollHeight-a.offsetHeight&&this.pageIndex<this.pages.length){var c=document.createDocumentFragment();b.each(this.pages[this.pageIndex],function(a,b){n(b,c,this.customOption)},this);a.appendChild(c);this.pageIndex++;this.emit("selectr.paginate",{items:this.items.length,total:this.data.length,page:this.pageIndex,pages:this.pages.length})}},q=function(){if(this.config.searchable||this.config.taggable)this.input.value=null,this.searching=!1,this.config.searchable&&
b.removeClass(this.inputContainer,"active"),b.hasClass(this.container,"notice")&&(b.removeClass(this.container,"notice"),b.addClass(this.container,"open"),this.input.focus()),b.each(this.items,function(a,c){b.removeClass(c,"excluded");this.customOption||(c.innerHTML=c.textContent)},this)};g=function(a,b){this.defaultConfig={defaultSelected:!0,width:"auto",disabled:!1,searchable:!0,clearable:!1,sortSelected:!1,allowDeselect:!1,closeOnScroll:!1,nativeDropdown:!1,nativeKeyboard:!1,placeholder:"Select an option...",
taggable:!1,tagPlaceholder:"Enter a tag...",messages:{noResults:"No results.",noOptions:"No options available.",maxSelections:"A maximum of {max} items can be selected.",tagDuplicate:"That tag is already in use."}};if(!a)throw Error("You must supply either a HTMLSelectElement or a CSS3 selector string.");this.el=a;"string"===typeof a&&(this.el=document.querySelector(a));if(null===this.el)throw Error("The element you passed to Selectr can not be found.");if("select"!==this.el.nodeName.toLowerCase())throw Error("The element you passed to Selectr is not a HTMLSelectElement.");
this.render(b)};g.prototype.render=function(a){if(!this.rendered){this.el.selectr=this;this.config=b.extend(this.defaultConfig,a);this.originalType=this.el.type;this.originalIndex=this.el.tabIndex;this.defaultSelected=[];this.originalOptionCount=this.el.options.length;if(this.config.multiple||this.config.taggable)this.el.multiple=!0;this.disabled=k(this.config,"disabled");this.opened=!1;this.config.taggable&&(this.config.searchable=!1);this.mobileDevice=this.navigating=!1;/Android|webOS|iPhone|iPad|BlackBerry|Windows Phone|Opera Mini|IEMobile|Mobile/i.test(navigator.userAgent)&&
(this.mobileDevice=!0);this.customOption=this.config.hasOwnProperty("renderOption")&&"function"===typeof this.config.renderOption;this.customSelected=this.config.hasOwnProperty("renderSelection")&&"function"===typeof this.config.renderSelection;this.supportsEventPassiveOption=this.detectEventPassiveOption();l.mixin(this);u.call(this);this.bindEvents();this.update();this.optsRect=b.rect(this.tree);this.rendered=!0;this.el.multiple||(this.el.selectedIndex=this.selectedIndex);var c=this;setTimeout(function(){c.emit("selectr.init")},
20)}};g.prototype.getSelected=function(){return this.el.querySelectorAll("option:checked")};g.prototype.getSelectedProperties=function(a){var b=this.getSelected();return[].slice.call(b).map(function(b){return b[a]}).filter(function(a){return null!==a&&void 0!==a})};g.prototype.detectEventPassiveOption=function(){var a=!1;try{var b=Object.defineProperty({},"passive",{get:function(){a=!0}});window.addEventListener("test",null,b)}catch(e){}return a};g.prototype.bindEvents=function(){var a=this;this.events=
{};this.events.dismiss=t.bind(this);this.events.navigate=v.bind(this);this.events.reset=this.reset.bind(this);if(this.config.nativeDropdown||this.mobileDevice){this.container.addEventListener("touchstart",function(b){b.changedTouches[0].target===a.el&&a.toggle()},this.supportsEventPassiveOption?{passive:!0}:!1);this.container.addEventListener("click",function(b){b.target===a.el&&a.toggle()});var c=function(a,b){for(var d=[],c=a.slice(0),e,f=0;f<b.length;f++)e=c.indexOf(b[f]),-1<e?c.splice(e,1):d.push(b[f]);
return[d,c]};this.el.addEventListener("change",function(d){a.el.multiple?(d=a.getSelectedProperties("idx"),d=c(a.selectedIndexes,d),b.each(d[0],function(b,d){a.select(d)},a),b.each(d[1],function(b,d){a.deselect(d)},a)):-1<a.el.selectedIndex&&a.select(a.el.selectedIndex)})}this.container.addEventListener("keydown",function(b){"Escape"===b.key&&a.close();"Enter"===b.key&&a.selected===document.activeElement&&"undefined"!==typeof a.el.form.submit&&a.el.form.submit();" "!==b.key&&"ArrowUp"!==b.key&&"ArrowDown"!==
b.key||a.selected!==document.activeElement||(setTimeout(function(){a.toggle()},200),a.config.nativeDropdown&&setTimeout(function(){a.el.focus()},200))});this.selected.addEventListener("click",function(b){a.disabled||a.toggle();b.preventDefault()});if(this.config.nativeKeyboard){var e="";this.selected.addEventListener("keydown",function(b){if(!(a.disabled||a.selected!==document.activeElement||b.altKey||b.ctrlKey||b.metaKey))if(" "===b.key||!a.opened&&-1<["Enter","ArrowUp","ArrowDown"].indexOf(b.key))a.toggle(),
b.preventDefault(),b.stopPropagation();else if(2>=b.key.length&&String[String.fromCodePoint?"fromCodePoint":"fromCharCode"](b.key[String.codePointAt?"codePointAt":"charCodeAt"](0))===b.key){if(a.config.multiple)a.open(),a.config.searchable&&(a.input.value=b.key,a.input.focus(),a.search(null,!0));else{e+=b.key;var c=a.search(e,!0);c&&c.length&&(a.clear(),a.setValue(c[0].value));setTimeout(function(){e=""},1E3)}b.preventDefault();b.stopPropagation()}});this.container.addEventListener("keyup",function(b){a.opened&&
"Escape"===b.key&&(a.close(),b.stopPropagation(),a.selected.focus())})}this.label.addEventListener("click",function(c){b.hasClass(c.target,"selectr-tag-remove")&&a.deselect(c.target.parentNode.idx)});this.selectClear&&this.selectClear.addEventListener("click",this.clear.bind(this));this.tree.addEventListener("mousedown",function(a){a.preventDefault()});this.tree.addEventListener("click",function(c){var d=b.closest(c.target,function(a){return a&&b.hasClass(a,"selectr-option")});d&&!b.hasClass(d,"disabled")&&
(b.hasClass(d,"selected")?(a.el.multiple||!a.el.multiple&&a.config.allowDeselect)&&a.deselect(d.idx):a.select(d.idx),a.opened&&!a.el.multiple&&a.close());c.preventDefault();c.stopPropagation()});this.tree.addEventListener("mouseover",function(c){b.hasClass(c.target,"selectr-option")&&!b.hasClass(c.target,"disabled")&&(b.removeClass(a.items[a.navIndex],"active"),b.addClass(c.target,"active"),a.navIndex=[].slice.call(a.items).indexOf(c.target))});this.config.searchable&&(this.input.addEventListener("focus",
function(b){a.searching=!0}),this.input.addEventListener("blur",function(b){a.searching=!1}),this.input.addEventListener("keyup",function(c){a.search();a.config.taggable||(this.value.length?b.addClass(this.parentNode,"active"):b.removeClass(this.parentNode,"active"))}),this.inputClear.addEventListener("click",function(b){a.input.value=null;q.call(a);a.tree.childElementCount||p.call(a)}));this.config.taggable&&this.input.addEventListener("keyup",function(c){a.search();if(a.config.taggable&&this.value.length){var d=
this.value.trim();if(13===c.which||b.includes(a.tagSeperators,c.key))b.each(a.tagSeperators,function(a,b){d=d.replace(b,"")}),a.add({value:d,text:d,selected:!0},!0)?(a.close(),q.call(a)):(this.value="",a.setMessage(a.config.messages.tagDuplicate))}});this.update=b.debounce(function(){a.opened&&a.config.closeOnScroll&&a.close();a.width&&(a.container.style.width=a.width);a.invert()},50);this.requiresPagination&&(this.paginateItems=b.debounce(function(){r.call(this)},50),this.tree.addEventListener("scroll",
this.paginateItems.bind(this)));document.addEventListener("click",this.events.dismiss);window.addEventListener("keydown",this.events.navigate);window.addEventListener("resize",this.update);window.addEventListener("scroll",this.update);this.on("selectr.destroy",function(){document.removeEventListener("click",this.events.dismiss);window.removeEventListener("keydown",this.events.navigate);window.removeEventListener("resize",this.update);window.removeEventListener("scroll",this.update)});this.el.form&&
(this.el.form.addEventListener("reset",this.events.reset),this.on("selectr.destroy",function(){this.el.form.removeEventListener("reset",this.events.reset)}))};g.prototype.setSelected=function(a){this.config.data||this.el.multiple||!this.el.options.length||(0!==this.el.selectedIndex||this.el.options[0].defaultSelected||this.config.defaultSelected||(this.el.selectedIndex=-1),this.selectedIndex=this.el.selectedIndex,-1<this.selectedIndex&&this.select(this.selectedIndex));this.config.multiple&&"select-one"===
this.originalType&&!this.config.data&&this.el.options[0].selected&&!this.el.options[0].defaultSelected&&(this.el.options[0].selected=!1);b.each(this.options,function(a,b){b.selected&&b.defaultSelected&&this.select(b.idx)},this);this.config.selectedValue&&this.setValue(this.config.selectedValue);if(this.config.data){!this.el.multiple&&this.config.defaultSelected&&0>this.el.selectedIndex&&this.select(0);var c=0;b.each(this.config.data,function(a,d){k(d,"children")?b.each(d.children,function(a,b){b.hasOwnProperty("selected")&&
!0===b.selected&&this.select(c);c++},this):(d.hasOwnProperty("selected")&&!0===d.selected&&this.select(c),c++)},this)}};g.prototype.destroy=function(){this.rendered&&(this.emit("selectr.destroy"),"select-one"===this.originalType&&(this.el.multiple=!1),this.config.data&&(this.el.innerHTML=""),b.removeClass(this.el,"selectr-hidden"),this.container.parentNode.replaceChild(this.el,this.container),this.rendered=!1,delete this.el.selectr)};g.prototype.change=function(a){var c=this.items[a],e=this.options[a];
e.disabled||(e.selected&&b.hasClass(c,"selected")?this.deselect(a):this.select(a),this.opened&&!this.el.multiple&&this.close())};g.prototype.select=function(a){var c=this.items[a],e=[].slice.call(this.el.options),d=this.options[a];if(this.el.multiple){if(b.includes(this.selectedIndexes,a))return!1;if(this.config.maxSelections&&this.tags.length===this.config.maxSelections)return this.setMessage(this.config.messages.maxSelections.replace("{max}",this.config.maxSelections),!0),!1;this.selectedValues.push(d.value);
this.selectedIndexes.push(a);w.call(this,c)}else{var f=this.data?this.data[a]:d;this.label.innerHTML=this.customSelected?this.config.renderSelection(f):d.textContent;this.selectedValue=d.value;this.selectedIndex=a;b.each(this.options,function(c,d){var e=this.items[c];c!==a&&(e&&b.removeClass(e,"selected"),d.selected=!1,d.removeAttribute("selected"))},this)}b.includes(e,d)||this.el.add(d);c.setAttribute("aria-selected",!0);b.addClass(c,"selected");b.addClass(this.container,"has-selected");d.selected=
!0;d.setAttribute("selected","");this.emit("selectr.change",d);this.emit("selectr.select",d);"createEvent"in document?(c=document.createEvent("HTMLEvents"),c.initEvent("change",!0,!0),this.el.dispatchEvent(c)):this.el.fireEvent("onchange")};g.prototype.deselect=function(a,c){var e=this.items[a],d=this.options[a];if(this.el.multiple){var f=this.selectedIndexes.indexOf(a);this.selectedIndexes.splice(f,1);f=this.selectedValues.indexOf(d.value);this.selectedValues.splice(f,1);x.call(this,e);this.tags.length||
b.removeClass(this.container,"has-selected")}else{if(!c&&!this.config.clearable&&!this.config.allowDeselect)return!1;this.label.innerHTML="";this.selectedValue=null;this.el.selectedIndex=this.selectedIndex=-1;b.removeClass(this.container,"has-selected")}this.items[a].setAttribute("aria-selected",!1);b.removeClass(this.items[a],"selected");d.selected=!1;d.removeAttribute("selected");this.emit("selectr.change",null);this.emit("selectr.deselect",d);"createEvent"in document?(e=document.createEvent("HTMLEvents"),
e.initEvent("change",!0,!0),this.el.dispatchEvent(e)):this.el.fireEvent("onchange")};g.prototype.setValue=function(a){var c=Array.isArray(a);c||(a=a.toString().trim());if(!this.el.multiple&&c)return!1;b.each(this.options,function(b,d){(c&&-1<a.indexOf(d.value)||d.value===a)&&this.change(d.idx)},this)};g.prototype.getValue=function(a,c){if(this.el.multiple)if(a){if(this.selectedIndexes.length){var e={values:[]};b.each(this.selectedIndexes,function(a,b){var c=this.options[b];e.values[a]={value:c.value,
text:c.textContent}},this)}}else e=this.selectedValues.slice();else if(a){var d=this.options[this.selectedIndex];e={value:d.value,text:d.textContent}}else e=this.selectedValue;a&&c&&(e=JSON.stringify(e));return e};g.prototype.add=function(a,c){if(a){this.data=this.data||[];this.items=this.items||[];this.options=this.options||[];if(Array.isArray(a))b.each(a,function(a,b){this.add(b,c)},this);else if("[object Object]"===Object.prototype.toString.call(a)){if(c){var e=!1;b.each(this.options,function(b,
c){c.value.toLowerCase()===a.value.toLowerCase()&&(e=!0)});if(e)return!1}var d=b.createElement("option",a);this.data.push(a);this.options.push(d);d.idx=0<this.options.length?this.options.length-1:0;m.call(this,d);a.selected&&this.select(d.idx);this.setPlaceholder();return d}this.config.pagination&&this.paginate();return!0}};g.prototype.remove=function(a){var c=[];Array.isArray(a)?b.each(a,function(a,e){b.isInt(e)?c.push(this.getOptionByIndex(e)):"string"===typeof e&&c.push(this.getOptionByValue(e))},
this):b.isInt(a)?c.push(this.getOptionByIndex(a)):"string"===typeof a&&c.push(this.getOptionByValue(a));if(c.length){var e;b.each(c,function(a,c){e=c.idx;this.el.remove(c);this.options.splice(e,1);var d=this.items[e].parentNode;d&&d.removeChild(this.items[e]);this.items.splice(e,1);b.each(this.options,function(a,b){b.idx=a;this.items[a].idx=a},this)},this);this.setPlaceholder();this.config.pagination&&this.paginate()}};g.prototype.removeAll=function(){this.clear(!0);b.each(this.el.options,function(a,
b){this.el.remove(b)},this);b.truncate(this.tree);this.items=[];this.options=[];this.data=[];this.navIndex=0;this.requiresPagination&&(this.requiresPagination=!1,this.pageIndex=1,this.pages=[]);this.setPlaceholder()};g.prototype.search=function(a,c){if(!this.navigating){var e=!1;a||(a=this.input.value,e=!0,this.removeMessage(),b.truncate(this.tree));var d=[],f=document.createDocumentFragment();a=a.trim().toLowerCase();if(0<a.length){var g=c?b.startsWith:b.includes;b.each(this.options,function(c,h){var k=
this.items[h.idx];if(g(h.textContent.trim().toLowerCase(),a)&&!h.disabled){if(d.push({text:h.textContent,value:h.value}),e&&(n(k,f,this.customOption),b.removeClass(k,"excluded"),!this.customOption)){var l=(l=(new RegExp(a,"i")).exec(h.textContent))?h.textContent.replace(l[0],"<span class='selectr-match'>"+l[0]+"</span>"):!1;k.innerHTML=l}}else e&&b.addClass(k,"excluded")},this);if(e){if(f.childElementCount){var k=this.items[this.navIndex],l=f.querySelector(".selectr-option:not(.excluded)");this.noResults=
!1;b.removeClass(k,"active");this.navIndex=l.idx;b.addClass(l,"active")}else this.config.taggable||(this.noResults=!0,this.setMessage(this.config.messages.noResults));this.tree.appendChild(f)}}else p.call(this);return d}};g.prototype.toggle=function(){this.disabled||(this.opened?this.close():this.open())};g.prototype.open=function(){var a=this;if(!this.options.length)return!1;this.opened||this.emit("selectr.open");this.opened=!0;this.mobileDevice||this.config.nativeDropdown?(b.addClass(this.container,
"native-open"),this.config.data&&b.each(this.options,function(a,b){this.el.add(b)},this)):(b.addClass(this.container,"open"),p.call(this),this.invert(),this.tree.scrollTop=0,b.removeClass(this.container,"notice"),this.selected.setAttribute("aria-expanded",!0),this.tree.setAttribute("aria-hidden",!1),this.tree.setAttribute("aria-expanded",!0),this.config.searchable&&!this.config.taggable&&setTimeout(function(){a.input.focus();a.input.tabIndex=0},10))};g.prototype.close=function(){this.opened&&this.emit("selectr.close");
this.navigating=this.opened=!1;if(this.mobileDevice||this.config.nativeDropdown)b.removeClass(this.container,"native-open");else{var a=b.hasClass(this.container,"notice");this.config.searchable&&!a&&(this.input.blur(),this.input.tabIndex=-1,this.searching=!1);a&&(b.removeClass(this.container,"notice"),this.notice.textContent="");b.removeClass(this.container,"open");b.removeClass(this.container,"native-open");this.selected.setAttribute("aria-expanded",!1);this.tree.setAttribute("aria-hidden",!0);this.tree.setAttribute("aria-expanded",
!1);b.truncate(this.tree);q.call(this);this.selected.focus()}};g.prototype.enable=function(){this.disabled=!1;this.el.disabled=!1;this.selected.tabIndex=this.originalIndex;this.el.multiple&&b.each(this.tags,function(a,b){b.lastElementChild.tabIndex=0});b.removeClass(this.container,"selectr-disabled")};g.prototype.disable=function(a){a||(this.el.disabled=!0);this.selected.tabIndex=-1;this.el.multiple&&b.each(this.tags,function(a,b){b.lastElementChild.tabIndex=-1});this.disabled=!0;b.addClass(this.container,
"selectr-disabled")};g.prototype.reset=function(){this.disabled||(this.clear(),this.setSelected(!0),b.each(this.defaultSelected,function(a,b){this.select(b)},this),this.emit("selectr.reset"))};g.prototype.clear=function(a){this.el.multiple?this.selectedIndexes.length&&(a=this.selectedIndexes.slice(),b.each(a,function(a,b){this.deselect(b)},this)):-1<this.selectedIndex&&this.deselect(this.selectedIndex,a);this.emit("selectr.clear")};g.prototype.serialise=function(a){var c=[];b.each(this.options,function(a,
b){var d={value:b.value,text:b.textContent};b.selected&&(d.selected=!0);b.disabled&&(d.disabled=!0);c[a]=d});return a?JSON.stringify(c):c};g.prototype.serialize=function(a){return this.serialise(a)};g.prototype.setPlaceholder=function(a){a=a||this.config.placeholder||this.el.getAttribute("placeholder");this.options.length||(a=this.config.messages.noOptions);this.placeEl.innerHTML=a};g.prototype.paginate=function(){if(this.items.length){var a=this;return this.pages=this.items.map(function(b,e){return 0===
e%a.config.pagination?a.items.slice(e,e+a.config.pagination):null}).filter(function(a){return a})}};g.prototype.setMessage=function(a,c){c&&this.close();b.addClass(this.container,"notice");this.notice.textContent=a};g.prototype.removeMessage=function(){b.removeClass(this.container,"notice");this.notice.innerHTML=""};g.prototype.invert=function(){var a=b.rect(this.selected);a.top+a.height+this.tree.parentNode.offsetHeight>window.innerHeight?(b.addClass(this.container,"inverted"),this.isInverted=!0):
(b.removeClass(this.container,"inverted"),this.isInverted=!1);this.optsRect=b.rect(this.tree)};g.prototype.getOptionByIndex=function(a){return this.options[a]};g.prototype.getOptionByValue=function(a){for(var b=!1,e=0,d=this.options.length;e<d;e++)if(this.options[e].value.trim()===a.toString().trim()){b=this.options[e];break}return b};return g});

//* Trumbowyg
/* ===========================================================
 * cs.js
 * Czech translation for Trumbowyg
 * http://alex-d.github.com/Trumbowyg
 * ===========================================================
 * Author : Jan Svoboda (https://github.com/svoboda-jan)
 */

jQuery.trumbowyg.langs.cs = {
    viewHTML: 'Zobrazit HTML',

    formatting: 'Formátování',
    p: 'Odstavec',
    blockquote: 'Citace',
    code: 'Kód',
    header: 'Nadpis',

    bold: 'Tučné',
    italic: 'Kurzíva',
    strikethrough: 'Přeškrtnuté',
    underline: 'Podtržené',

    strong: 'Tučné',
    em: 'Zvýraznit',
    del: 'Smazat',

    unorderedList: 'Netříděný seznam',
    orderedList: 'Tříděný seznam',

    insertImage: 'Vložit obrázek',
    insertVideo: 'Vložit video',
    link: 'Odkaz',
    createLink: 'Vložit odkaz',
    unlink: 'Smazat odkaz',

    justifyLeft: 'Zarovnat doleva',
    justifyCenter: 'Zarovnat na střed',
    justifyRight: 'Zarovnat doprava',
    justifyFull: 'Zarovnat do bloku',

    horizontalRule: 'Vložit vodorovnou čáru',

    fullscreen: 'Režim celé obrazovky',

    close: 'Zavřít',

    submit: 'Potvrdit',
    reset: 'Zrušit',

    required: 'Povinné',
    description: 'Popis',
    title: 'Nadpis',
    text: 'Text'
};

