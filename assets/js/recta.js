! function (e, t) {
	"object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? exports.recta = t() : e.Recta = t()
}(this, function () {
	return function (e) {
		function __webpack_require__(r) {
			if (t[r]) return t[r].exports;
			var n = t[r] = {
				i: r,
				l: !1,
				exports: {}
			};
			return e[r].call(n.exports, n, n.exports, __webpack_require__), n.l = !0, n.exports
		}
		var t = {};
		return __webpack_require__.m = e, __webpack_require__.c = t, __webpack_require__.d = function (e, t, r) {
			__webpack_require__.o(e, t) || Object.defineProperty(e, t, {
				configurable: !1,
				enumerable: !0,
				get: r
			})
		}, __webpack_require__.n = function (e) {
			var t = e && e.__esModule ? function () {
				return e.default
			} : function () {
				return e
			};
			return __webpack_require__.d(t, "a", t), t
		}, __webpack_require__.o = function (e, t) {
			return Object.prototype.hasOwnProperty.call(e, t)
		}, __webpack_require__.p = "", __webpack_require__(__webpack_require__.s = 22)
	}([function (e, t) {
		var r;
		r = function () {
			return this
		}();
		try {
			r = r || Function("return this")() || (0, eval)("this")
		} catch (e) {
			"object" == typeof window && (r = window)
		}
		e.exports = r
	}, function (e, t, r) {
		(function (n) {
			function useColors() {
				return !("undefined" == typeof window || !window.process || "renderer" !== window.process.type) || ("undefined" != typeof document && document.documentElement && document.documentElement.style && document.documentElement.style.WebkitAppearance || "undefined" != typeof window && window.console && (window.console.firebug || window.console.exception && window.console.table) || "undefined" != typeof navigator && navigator.userAgent && navigator.userAgent.toLowerCase().match(/firefox\/(\d+)/) && parseInt(RegExp.$1, 10) >= 31 || "undefined" != typeof navigator && navigator.userAgent && navigator.userAgent.toLowerCase().match(/applewebkit\/(\d+)/))
			}

			function formatArgs(e) {
				var r = this.useColors;
				if (e[0] = (r ? "%c" : "") + this.namespace + (r ? " %c" : " ") + e[0] + (r ? "%c " : " ") + "+" + t.humanize(this.diff), r) {
					var n = "color: " + this.color;
					e.splice(1, 0, n, "color: inherit");
					var o = 0,
						i = 0;
					e[0].replace(/%[a-zA-Z%]/g, function (e) {
						"%%" !== e && (o++, "%c" === e && (i = o))
					}), e.splice(i, 0, n)
				}
			}

			function log() {
				return "object" == typeof console && console.log && Function.prototype.apply.call(console.log, console, arguments)
			}

			function save(e) {
				try {
					null == e ? t.storage.removeItem("debug") : t.storage.debug = e
				} catch (e) {}
			}

			function load() {
				var e;
				try {
					e = t.storage.debug
				} catch (e) {}
				return !e && void 0 !== n && "env" in n && (e = n.env.DEBUG), e
			}
			t = e.exports = r(27), t.log = log, t.formatArgs = formatArgs, t.save = save, t.load = load, t.useColors = useColors, t.storage = "undefined" != typeof chrome && void 0 !== chrome.storage ? chrome.storage.local : function () {
				try {
					return window.localStorage
				} catch (e) {}
			}(), t.colors = ["lightseagreen", "forestgreen", "goldenrod", "dodgerblue", "darkorchid", "crimson"], t.formatters.j = function (e) {
				try {
					return JSON.stringify(e)
				} catch (e) {
					return "[UnexpectedJSONParseError]: " + e.message
				}
			}, t.enable(load())
		}).call(t, r(26))
	}, function (e, t, r) {
		function Emitter(e) {
			if (e) return mixin(e)
		}

		function mixin(e) {
			for (var t in Emitter.prototype) e[t] = Emitter.prototype[t];
			return e
		}
		e.exports = Emitter, Emitter.prototype.on = Emitter.prototype.addEventListener = function (e, t) {
			return this._callbacks = this._callbacks || {}, (this._callbacks["$" + e] = this._callbacks["$" + e] || []).push(t), this
		}, Emitter.prototype.once = function (e, t) {
			function on() {
				this.off(e, on), t.apply(this, arguments)
			}
			return on.fn = t, this.on(e, on), this
		}, Emitter.prototype.off = Emitter.prototype.removeListener = Emitter.prototype.removeAllListeners = Emitter.prototype.removeEventListener = function (e, t) {
			if (this._callbacks = this._callbacks || {}, 0 == arguments.length) return this._callbacks = {}, this;
			var r = this._callbacks["$" + e];
			if (!r) return this;
			if (1 == arguments.length) return delete this._callbacks["$" + e], this;
			for (var n, o = 0; o < r.length; o++)
				if ((n = r[o]) === t || n.fn === t) {
					r.splice(o, 1);
					break
				} return this
		}, Emitter.prototype.emit = function (e) {
			this._callbacks = this._callbacks || {};
			var t = [].slice.call(arguments, 1),
				r = this._callbacks["$" + e];
			if (r) {
				r = r.slice(0);
				for (var n = 0, o = r.length; n < o; ++n) r[n].apply(this, t)
			}
			return this
		}, Emitter.prototype.listeners = function (e) {
			return this._callbacks = this._callbacks || {}, this._callbacks["$" + e] || []
		}, Emitter.prototype.hasListeners = function (e) {
			return !!this.listeners(e).length
		}
	}, function (e, t, r) {
		(function (e) {
			function encodeBase64Object(e, r) {
				return r("b" + t.packets[e.type] + e.data.data)
			}

			function encodeArrayBuffer(e, r, n) {
				if (!r) return t.encodeBase64Packet(e, n);
				var o = e.data,
					i = new Uint8Array(o),
					s = new Uint8Array(1 + o.byteLength);
				s[0] = p[e.type];
				for (var a = 0; a < i.length; a++) s[a + 1] = i[a];
				return n(s.buffer)
			}

			function encodeBlobAsArrayBuffer(e, r, n) {
				if (!r) return t.encodeBase64Packet(e, n);
				var o = new FileReader;
				return o.onload = function () {
					e.data = o.result, t.encodePacket(e, r, !0, n)
				}, o.readAsArrayBuffer(e.data)
			}

			function encodeBlob(e, r, n) {
				if (!r) return t.encodeBase64Packet(e, n);
				if (h) return encodeBlobAsArrayBuffer(e, r, n);
				var o = new Uint8Array(1);
				return o[0] = p[e.type], n(new y([o.buffer, e.data]))
			}

			function tryDecode(e) {
				try {
					e = c.decode(e, {
						strict: !1
					})
				} catch (e) {
					return !1
				}
				return e
			}

			function map(e, t, r) {
				for (var n = new Array(e.length), o = a(e.length, r), i = 0; i < e.length; i++) ! function (e, r, o) {
					t(r, function (t, r) {
						n[e] = r, o(t, n)
					})
				}(i, e[i], o)
			}
			var n, o = r(35),
				i = r(10),
				s = r(36),
				a = r(37),
				c = r(38);
			e && e.ArrayBuffer && (n = r(40));
			var u = "undefined" != typeof navigator && /Android/i.test(navigator.userAgent),
				f = "undefined" != typeof navigator && /PhantomJS/i.test(navigator.userAgent),
				h = u || f;
			t.protocol = 3;
			var p = t.packets = {
					open: 0,
					close: 1,
					ping: 2,
					pong: 3,
					message: 4,
					upgrade: 5,
					noop: 6
				},
				l = o(p),
				d = {
					type: "error",
					data: "parser error"
				},
				y = r(41);
			t.encodePacket = function (t, r, n, o) {
				"function" == typeof r && (o = r, r = !1), "function" == typeof n && (o = n, n = null);
				var i = void 0 === t.data ? void 0 : t.data.buffer || t.data;
				if (e.ArrayBuffer && i instanceof ArrayBuffer) return encodeArrayBuffer(t, r, o);
				if (y && i instanceof e.Blob) return encodeBlob(t, r, o);
				if (i && i.base64) return encodeBase64Object(t, o);
				var s = p[t.type];
				return void 0 !== t.data && (s += n ? c.encode(String(t.data), {
					strict: !1
				}) : String(t.data)), o("" + s)
			}, t.encodeBase64Packet = function (r, n) {
				var o = "b" + t.packets[r.type];
				if (y && r.data instanceof e.Blob) {
					var i = new FileReader;
					return i.onload = function () {
						var e = i.result.split(",")[1];
						n(o + e)
					}, i.readAsDataURL(r.data)
				}
				var s;
				try {
					s = String.fromCharCode.apply(null, new Uint8Array(r.data))
				} catch (e) {
					for (var a = new Uint8Array(r.data), c = new Array(a.length), u = 0; u < a.length; u++) c[u] = a[u];
					s = String.fromCharCode.apply(null, c)
				}
				return o += e.btoa(s), n(o)
			}, t.decodePacket = function (e, r, n) {
				if (void 0 === e) return d;
				if ("string" == typeof e) {
					if ("b" === e.charAt(0)) return t.decodeBase64Packet(e.substr(1), r);
					if (n && !1 === (e = tryDecode(e))) return d;
					var o = e.charAt(0);
					return Number(o) == o && l[o] ? e.length > 1 ? {
						type: l[o],
						data: e.substring(1)
					} : {
						type: l[o]
					} : d
				}
				var i = new Uint8Array(e),
					o = i[0],
					a = s(e, 1);
				return y && "blob" === r && (a = new y([a])), {
					type: l[o],
					data: a
				}
			}, t.decodeBase64Packet = function (e, t) {
				var r = l[e.charAt(0)];
				if (!n) return {
					type: r,
					data: {
						base64: !0,
						data: e.substr(1)
					}
				};
				var o = n.decode(e.substr(1));
				return "blob" === t && y && (o = new y([o])), {
					type: r,
					data: o
				}
			}, t.encodePayload = function (e, r, n) {
				function setLengthHeader(e) {
					return e.length + ":" + e
				}

				function encodeOne(e, n) {
					t.encodePacket(e, !!o && r, !1, function (e) {
						n(null, setLengthHeader(e))
					})
				}
				"function" == typeof r && (n = r, r = null);
				var o = i(e);
				return r && o ? y && !h ? t.encodePayloadAsBlob(e, n) : t.encodePayloadAsArrayBuffer(e, n) : e.length ? void map(e, encodeOne, function (e, t) {
					return n(t.join(""))
				}) : n("0:")
			}, t.decodePayload = function (e, r, n) {
				if ("string" != typeof e) return t.decodePayloadAsBinary(e, r, n);
				"function" == typeof r && (n = r, r = null);
				var o;
				if ("" === e) return n(d, 0, 1);
				for (var i, s, a = "", c = 0, u = e.length; c < u; c++) {
					var f = e.charAt(c);
					if (":" === f) {
						if ("" === a || a != (i = Number(a))) return n(d, 0, 1);
						if (s = e.substr(c + 1, i), a != s.length) return n(d, 0, 1);
						if (s.length) {
							if (o = t.decodePacket(s, r, !1), d.type === o.type && d.data === o.data) return n(d, 0, 1);
							if (!1 === n(o, c + i, u)) return
						}
						c += i, a = ""
					} else a += f
				}
				return "" !== a ? n(d, 0, 1) : void 0
			}, t.encodePayloadAsArrayBuffer = function (e, r) {
				function encodeOne(e, r) {
					t.encodePacket(e, !0, !0, function (e) {
						return r(null, e)
					})
				}
				if (!e.length) return r(new ArrayBuffer(0));
				map(e, encodeOne, function (e, t) {
					var n = t.reduce(function (e, t) {
							var r;
							return r = "string" == typeof t ? t.length : t.byteLength, e + r.toString().length + r + 2
						}, 0),
						o = new Uint8Array(n),
						i = 0;
					return t.forEach(function (e) {
						var t = "string" == typeof e,
							r = e;
						if (t) {
							for (var n = new Uint8Array(e.length), s = 0; s < e.length; s++) n[s] = e.charCodeAt(s);
							r = n.buffer
						}
						o[i++] = t ? 0 : 1;
						for (var a = r.byteLength.toString(), s = 0; s < a.length; s++) o[i++] = parseInt(a[s]);
						o[i++] = 255;
						for (var n = new Uint8Array(r), s = 0; s < n.length; s++) o[i++] = n[s]
					}), r(o.buffer)
				})
			}, t.encodePayloadAsBlob = function (e, r) {
				function encodeOne(e, r) {
					t.encodePacket(e, !0, !0, function (e) {
						var t = new Uint8Array(1);
						if (t[0] = 1, "string" == typeof e) {
							for (var n = new Uint8Array(e.length), o = 0; o < e.length; o++) n[o] = e.charCodeAt(o);
							e = n.buffer, t[0] = 0
						}
						for (var i = e instanceof ArrayBuffer ? e.byteLength : e.size, s = i.toString(), a = new Uint8Array(s.length + 1), o = 0; o < s.length; o++) a[o] = parseInt(s[o]);
						if (a[s.length] = 255, y) {
							var c = new y([t.buffer, a.buffer, e]);
							r(null, c)
						}
					})
				}
				map(e, encodeOne, function (e, t) {
					return r(new y(t))
				})
			}, t.decodePayloadAsBinary = function (e, r, n) {
				"function" == typeof r && (n = r, r = null);
				for (var o = e, i = []; o.byteLength > 0;) {
					for (var a = new Uint8Array(o), c = 0 === a[0], u = "", f = 1; 255 !== a[f]; f++) {
						if (u.length > 310) return n(d, 0, 1);
						u += a[f]
					}
					o = s(o, 2 + u.length), u = parseInt(u);
					var h = s(o, 0, u);
					if (c) try {
						h = String.fromCharCode.apply(null, new Uint8Array(h))
					} catch (e) {
						var p = new Uint8Array(h);
						h = "";
						for (var f = 0; f < p.length; f++) h += String.fromCharCode(p[f])
					}
					i.push(h), o = s(o, u)
				}
				var l = i.length;
				i.forEach(function (e, o) {
					n(t.decodePacket(e, r, !0), o, l)
				})
			}
		}).call(t, r(0))
	}, function (e, t) {
		t.encode = function (e) {
			var t = "";
			for (var r in e) e.hasOwnProperty(r) && (t.length && (t += "&"), t += encodeURIComponent(r) + "=" + encodeURIComponent(e[r]));
			return t
		}, t.decode = function (e) {
			for (var t = {}, r = e.split("&"), n = 0, o = r.length; n < o; n++) {
				var i = r[n].split("=");
				t[decodeURIComponent(i[0])] = decodeURIComponent(i[1])
			}
			return t
		}
	}, function (e, t) {
		e.exports = function (e, t) {
			var r = function () {};
			r.prototype = t.prototype, e.prototype = new r, e.prototype.constructor = e
		}
	}, function (e, t, r) {
		function Encoder() {}

		function encodeAsString(e) {
			var r = "" + e.type;
			return t.BINARY_EVENT !== e.type && t.BINARY_ACK !== e.type || (r += e.attachments + "-"), e.nsp && "/" !== e.nsp && (r += e.nsp + ","), null != e.id && (r += e.id), null != e.data && (r += JSON.stringify(e.data)), n("encoded %j as %s", e, r), r
		}

		function encodeAsBinary(e, t) {
			function writeEncoding(e) {
				var r = s.deconstructPacket(e),
					n = encodeAsString(r.packet),
					o = r.buffers;
				o.unshift(n), t(o)
			}
			s.removeBlobs(e, writeEncoding)
		}

		function Decoder() {
			this.reconstructor = null
		}

		function decodeString(e) {
			var r = 0,
				o = {
					type: Number(e.charAt(0))
				};
			if (null == t.types[o.type]) return error();
			if (t.BINARY_EVENT === o.type || t.BINARY_ACK === o.type) {
				for (var i = "";
					"-" !== e.charAt(++r) && (i += e.charAt(r), r != e.length););
				if (i != Number(i) || "-" !== e.charAt(r)) throw new Error("Illegal attachments");
				o.attachments = Number(i)
			}
			if ("/" === e.charAt(r + 1))
				for (o.nsp = ""; ++r;) {
					var s = e.charAt(r);
					if ("," === s) break;
					if (o.nsp += s, r === e.length) break
				} else o.nsp = "/";
			var a = e.charAt(r + 1);
			if ("" !== a && Number(a) == a) {
				for (o.id = ""; ++r;) {
					var s = e.charAt(r);
					if (null == s || Number(s) != s) {
						--r;
						break
					}
					if (o.id += e.charAt(r), r === e.length) break
				}
				o.id = Number(o.id)
			}
			return e.charAt(++r) && (o = tryParse(o, e.substr(r))), n("decoded %s as %j", e, o), o
		}

		function tryParse(e, t) {
			try {
				e.data = JSON.parse(t)
			} catch (e) {
				return error()
			}
			return e
		}

		function BinaryReconstructor(e) {
			this.reconPack = e, this.buffers = []
		}

		function error() {
			return {
				type: t.ERROR,
				data: "parser error"
			}
		}
		var n = r(1)("socket.io-parser"),
			o = r(2),
			i = r(10),
			s = r(29),
			a = r(12);
		t.protocol = 4, t.types = ["CONNECT", "DISCONNECT", "EVENT", "ACK", "ERROR", "BINARY_EVENT", "BINARY_ACK"], t.CONNECT = 0, t.DISCONNECT = 1, t.EVENT = 2, t.ACK = 3, t.ERROR = 4, t.BINARY_EVENT = 5, t.BINARY_ACK = 6, t.Encoder = Encoder, t.Decoder = Decoder, Encoder.prototype.encode = function (e, r) {
			if (e.type !== t.EVENT && e.type !== t.ACK || !i(e.data) || (e.type = e.type === t.EVENT ? t.BINARY_EVENT : t.BINARY_ACK), n("encoding packet %j", e), t.BINARY_EVENT === e.type || t.BINARY_ACK === e.type) encodeAsBinary(e, r);
			else {
				r([encodeAsString(e)])
			}
		}, o(Decoder.prototype), Decoder.prototype.add = function (e) {
			var r;
			if ("string" == typeof e) r = decodeString(e), t.BINARY_EVENT === r.type || t.BINARY_ACK === r.type ? (this.reconstructor = new BinaryReconstructor(r), 0 === this.reconstructor.reconPack.attachments && this.emit("decoded", r)) : this.emit("decoded", r);
			else {
				if (!a(e) && !e.base64) throw new Error("Unknown type: " + e);
				if (!this.reconstructor) throw new Error("got binary data when not reconstructing a packet");
				(r = this.reconstructor.takeBinaryData(e)) && (this.reconstructor = null, this.emit("decoded", r))
			}
		}, Decoder.prototype.destroy = function () {
			this.reconstructor && this.reconstructor.finishedReconstruction()
		}, BinaryReconstructor.prototype.takeBinaryData = function (e) {
			if (this.buffers.push(e), this.buffers.length === this.reconPack.attachments) {
				var t = s.reconstructPacket(this.reconPack, this.buffers);
				return this.finishedReconstruction(), t
			}
			return null
		}, BinaryReconstructor.prototype.finishedReconstruction = function () {
			this.reconPack = null, this.buffers = []
		}
	}, function (e, t, r) {
		(function (t) {
			var n = r(33);
			e.exports = function (e) {
				var r = e.xdomain,
					o = e.xscheme,
					i = e.enablesXDR;
				try {
					if ("undefined" != typeof XMLHttpRequest && (!r || n)) return new XMLHttpRequest
				} catch (e) {}
				try {
					if ("undefined" != typeof XDomainRequest && !o && i) return new XDomainRequest
				} catch (e) {}
				if (!r) try {
					return new(t[["Active"].concat("Object").join("X")])("Microsoft.XMLHTTP")
				} catch (e) {}
			}
		}).call(t, r(0))
	}, function (e, t, r) {
		function Transport(e) {
			this.path = e.path, this.hostname = e.hostname, this.port = e.port, this.secure = e.secure, this.query = e.query, this.timestampParam = e.timestampParam, this.timestampRequests = e.timestampRequests, this.readyState = "", this.agent = e.agent || !1, this.socket = e.socket, this.enablesXDR = e.enablesXDR, this.pfx = e.pfx, this.key = e.key, this.passphrase = e.passphrase, this.cert = e.cert, this.ca = e.ca, this.ciphers = e.ciphers, this.rejectUnauthorized = e.rejectUnauthorized, this.forceNode = e.forceNode, this.extraHeaders = e.extraHeaders, this.localAddress = e.localAddress
		}
		var n = r(3),
			o = r(2);
		e.exports = Transport, o(Transport.prototype), Transport.prototype.onError = function (e, t) {
			var r = new Error(e);
			return r.type = "TransportError", r.description = t, this.emit("error", r), this
		}, Transport.prototype.open = function () {
			return "closed" !== this.readyState && "" !== this.readyState || (this.readyState = "opening", this.doOpen()), this
		}, Transport.prototype.close = function () {
			return "opening" !== this.readyState && "open" !== this.readyState || (this.doClose(), this.onClose()), this
		}, Transport.prototype.send = function (e) {
			if ("open" !== this.readyState) throw new Error("Transport not open");
			this.write(e)
		}, Transport.prototype.onOpen = function () {
			this.readyState = "open", this.writable = !0, this.emit("open")
		}, Transport.prototype.onData = function (e) {
			var t = n.decodePacket(e, this.socket.binaryType);
			this.onPacket(t)
		}, Transport.prototype.onPacket = function (e) {
			this.emit("packet", e)
		}, Transport.prototype.onClose = function () {
			this.readyState = "closed", this.emit("close")
		}
	}, function (e, t) {
		var r = /^(?:(?![^:@]+:[^:@\/]*@)(http|https|ws|wss):\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?((?:[a-f0-9]{0,4}:){2,7}[a-f0-9]{0,4}|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/,
			n = ["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "anchor"];
		e.exports = function (e) {
			var t = e,
				o = e.indexOf("["),
				i = e.indexOf("]"); - 1 != o && -1 != i && (e = e.substring(0, o) + e.substring(o, i).replace(/:/g, ";") + e.substring(i, e.length));
			for (var s = r.exec(e || ""), a = {}, c = 14; c--;) a[n[c]] = s[c] || "";
			return -1 != o && -1 != i && (a.source = t, a.host = a.host.substring(1, a.host.length - 1).replace(/;/g, ":"), a.authority = a.authority.replace("[", "").replace("]", "").replace(/;/g, ":"), a.ipv6uri = !0), a
		}
	}, function (e, t, r) {
		(function (t) {
			function hasBinary(e) {
				if (!e || "object" != typeof e) return !1;
				if (n(e)) {
					for (var r = 0, o = e.length; r < o; r++)
						if (hasBinary(e[r])) return !0;
					return !1
				}
				if ("function" == typeof t.Buffer && t.Buffer.isBuffer && t.Buffer.isBuffer(e) || "function" == typeof t.ArrayBuffer && e instanceof ArrayBuffer || i && e instanceof Blob || s && e instanceof File) return !0;
				if (e.toJSON && "function" == typeof e.toJSON && 1 === arguments.length) return hasBinary(e.toJSON(), !0);
				for (var a in e)
					if (Object.prototype.hasOwnProperty.call(e, a) && hasBinary(e[a])) return !0;
				return !1
			}
			var n = r(11),
				o = Object.prototype.toString,
				i = "function" == typeof t.Blob || "[object BlobConstructor]" === o.call(t.Blob),
				s = "function" == typeof t.File || "[object FileConstructor]" === o.call(t.File);
			e.exports = hasBinary
		}).call(t, r(0))
	}, function (e, t) {
		var r = {}.toString;
		e.exports = Array.isArray || function (e) {
			return "[object Array]" == r.call(e)
		}
	}, function (e, t, r) {
		(function (t) {
			function isBuf(e) {
				return t.Buffer && t.Buffer.isBuffer(e) || t.ArrayBuffer && e instanceof ArrayBuffer
			}
			e.exports = isBuf
		}).call(t, r(0))
	}, function (e, t, r) {
		function Manager(e, t) {
			if (!(this instanceof Manager)) return new Manager(e, t);
			e && "object" == typeof e && (t = e, e = void 0), t = t || {}, t.path = t.path || "/socket.io", this.nsps = {}, this.subs = [], this.opts = t, this.reconnection(!1 !== t.reconnection), this.reconnectionAttempts(t.reconnectionAttempts || 1 / 0), this.reconnectionDelay(t.reconnectionDelay || 1e3), this.reconnectionDelayMax(t.reconnectionDelayMax || 5e3), this.randomizationFactor(t.randomizationFactor || .5), this.backoff = new h({
				min: this.reconnectionDelay(),
				max: this.reconnectionDelayMax(),
				jitter: this.randomizationFactor()
			}), this.timeout(null == t.timeout ? 2e4 : t.timeout), this.readyState = "closed", this.uri = e, this.connecting = [], this.lastPing = null, this.encoding = !1, this.packetBuffer = [];
			var r = t.parser || s;
			this.encoder = new r.Encoder, this.decoder = new r.Decoder, this.autoConnect = !1 !== t.autoConnect, this.autoConnect && this.open()
		}
		var n = r(30),
			o = r(18),
			i = r(2),
			s = r(6),
			a = r(19),
			c = r(20),
			u = r(1)("socket.io-client:manager"),
			f = r(17),
			h = r(47),
			p = Object.prototype.hasOwnProperty;
		e.exports = Manager, Manager.prototype.emitAll = function () {
			this.emit.apply(this, arguments);
			for (var e in this.nsps) p.call(this.nsps, e) && this.nsps[e].emit.apply(this.nsps[e], arguments)
		}, Manager.prototype.updateSocketIds = function () {
			for (var e in this.nsps) p.call(this.nsps, e) && (this.nsps[e].id = this.generateId(e))
		}, Manager.prototype.generateId = function (e) {
			return ("/" === e ? "" : e + "#") + this.engine.id
		}, i(Manager.prototype), Manager.prototype.reconnection = function (e) {
			return arguments.length ? (this._reconnection = !!e, this) : this._reconnection
		}, Manager.prototype.reconnectionAttempts = function (e) {
			return arguments.length ? (this._reconnectionAttempts = e, this) : this._reconnectionAttempts
		}, Manager.prototype.reconnectionDelay = function (e) {
			return arguments.length ? (this._reconnectionDelay = e, this.backoff && this.backoff.setMin(e), this) : this._reconnectionDelay
		}, Manager.prototype.randomizationFactor = function (e) {
			return arguments.length ? (this._randomizationFactor = e, this.backoff && this.backoff.setJitter(e), this) : this._randomizationFactor
		}, Manager.prototype.reconnectionDelayMax = function (e) {
			return arguments.length ? (this._reconnectionDelayMax = e, this.backoff && this.backoff.setMax(e), this) : this._reconnectionDelayMax
		}, Manager.prototype.timeout = function (e) {
			return arguments.length ? (this._timeout = e, this) : this._timeout
		}, Manager.prototype.maybeReconnectOnOpen = function () {
			!this.reconnecting && this._reconnection && 0 === this.backoff.attempts && this.reconnect()
		}, Manager.prototype.open = Manager.prototype.connect = function (e, t) {
			if (u("readyState %s", this.readyState), ~this.readyState.indexOf("open")) return this;
			u("opening %s", this.uri), this.engine = n(this.uri, this.opts);
			var r = this.engine,
				o = this;
			this.readyState = "opening", this.skipReconnect = !1;
			var i = a(r, "open", function () {
					o.onopen(), e && e()
				}),
				s = a(r, "error", function (t) {
					if (u("connect_error"), o.cleanup(), o.readyState = "closed", o.emitAll("connect_error", t), e) {
						var r = new Error("Connection error");
						r.data = t, e(r)
					} else o.maybeReconnectOnOpen()
				});
			if (!1 !== this._timeout) {
				var c = this._timeout;
				u("connect attempt will timeout after %d", c);
				var f = setTimeout(function () {
					u("connect attempt timed out after %d", c), i.destroy(), r.close(), r.emit("error", "timeout"), o.emitAll("connect_timeout", c)
				}, c);
				this.subs.push({
					destroy: function () {
						clearTimeout(f)
					}
				})
			}
			return this.subs.push(i), this.subs.push(s), this
		}, Manager.prototype.onopen = function () {
			u("open"), this.cleanup(), this.readyState = "open", this.emit("open");
			var e = this.engine;
			this.subs.push(a(e, "data", c(this, "ondata"))), this.subs.push(a(e, "ping", c(this, "onping"))), this.subs.push(a(e, "pong", c(this, "onpong"))), this.subs.push(a(e, "error", c(this, "onerror"))), this.subs.push(a(e, "close", c(this, "onclose"))), this.subs.push(a(this.decoder, "decoded", c(this, "ondecoded")))
		}, Manager.prototype.onping = function () {
			this.lastPing = new Date, this.emitAll("ping")
		}, Manager.prototype.onpong = function () {
			this.emitAll("pong", new Date - this.lastPing)
		}, Manager.prototype.ondata = function (e) {
			this.decoder.add(e)
		}, Manager.prototype.ondecoded = function (e) {
			this.emit("packet", e)
		}, Manager.prototype.onerror = function (e) {
			u("error", e), this.emitAll("error", e)
		}, Manager.prototype.socket = function (e, t) {
			function onConnecting() {
				~f(n.connecting, r) || n.connecting.push(r)
			}
			var r = this.nsps[e];
			if (!r) {
				r = new o(this, e, t), this.nsps[e] = r;
				var n = this;
				r.on("connecting", onConnecting), r.on("connect", function () {
					r.id = n.generateId(e)
				}), this.autoConnect && onConnecting()
			}
			return r
		}, Manager.prototype.destroy = function (e) {
			var t = f(this.connecting, e);
			~t && this.connecting.splice(t, 1), this.connecting.length || this.close()
		}, Manager.prototype.packet = function (e) {
			u("writing packet %j", e);
			var t = this;
			e.query && 0 === e.type && (e.nsp += "?" + e.query), t.encoding ? t.packetBuffer.push(e) : (t.encoding = !0, this.encoder.encode(e, function (r) {
				for (var n = 0; n < r.length; n++) t.engine.write(r[n], e.options);
				t.encoding = !1, t.processPacketQueue()
			}))
		}, Manager.prototype.processPacketQueue = function () {
			if (this.packetBuffer.length > 0 && !this.encoding) {
				var e = this.packetBuffer.shift();
				this.packet(e)
			}
		}, Manager.prototype.cleanup = function () {
			u("cleanup");
			for (var e = this.subs.length, t = 0; t < e; t++) {
				this.subs.shift().destroy()
			}
			this.packetBuffer = [], this.encoding = !1, this.lastPing = null, this.decoder.destroy()
		}, Manager.prototype.close = Manager.prototype.disconnect = function () {
			u("disconnect"), this.skipReconnect = !0, this.reconnecting = !1, "opening" === this.readyState && this.cleanup(), this.backoff.reset(), this.readyState = "closed", this.engine && this.engine.close()
		}, Manager.prototype.onclose = function (e) {
			u("onclose"), this.cleanup(), this.backoff.reset(), this.readyState = "closed", this.emit("close", e), this._reconnection && !this.skipReconnect && this.reconnect()
		}, Manager.prototype.reconnect = function () {
			if (this.reconnecting || this.skipReconnect) return this;
			var e = this;
			if (this.backoff.attempts >= this._reconnectionAttempts) u("reconnect failed"), this.backoff.reset(), this.emitAll("reconnect_failed"), this.reconnecting = !1;
			else {
				var t = this.backoff.duration();
				u("will wait %dms before reconnect attempt", t), this.reconnecting = !0;
				var r = setTimeout(function () {
					e.skipReconnect || (u("attempting reconnect"), e.emitAll("reconnect_attempt", e.backoff.attempts), e.emitAll("reconnecting", e.backoff.attempts), e.skipReconnect || e.open(function (t) {
						t ? (u("reconnect attempt error"), e.reconnecting = !1, e.reconnect(), e.emitAll("reconnect_error", t.data)) : (u("reconnect success"), e.onreconnect())
					}))
				}, t);
				this.subs.push({
					destroy: function () {
						clearTimeout(r)
					}
				})
			}
		}, Manager.prototype.onreconnect = function () {
			var e = this.backoff.attempts;
			this.reconnecting = !1, this.backoff.reset(), this.updateSocketIds(), this.emitAll("reconnect", e)
		}
	}, function (e, t, r) {
		(function (e) {
			function polling(t) {
				var r = !1,
					s = !1,
					a = !1 !== t.jsonp;
				if (e.location) {
					var c = "https:" === location.protocol,
						u = location.port;
					u || (u = c ? 443 : 80), r = t.hostname !== location.hostname || u !== t.port, s = t.secure !== c
				}
				if (t.xdomain = r, t.xscheme = s, "open" in new n(t) && !t.forceJSONP) return new o(t);
				if (!a) throw new Error("JSONP disabled");
				return new i(t)
			}
			var n = r(7),
				o = r(34),
				i = r(42),
				s = r(43);
			t.polling = polling, t.websocket = s
		}).call(t, r(0))
	}, function (e, t, r) {
		function Polling(e) {
			var t = e && e.forceBase64;
			u && !t || (this.supportsBinary = !1), n.call(this, e)
		}
		var n = r(8),
			o = r(4),
			i = r(3),
			s = r(5),
			a = r(16),
			c = r(1)("engine.io-client:polling");
		e.exports = Polling;
		var u = function () {
			return null != new(r(7))({
				xdomain: !1
			}).responseType
		}();
		s(Polling, n), Polling.prototype.name = "polling", Polling.prototype.doOpen = function () {
			this.poll()
		}, Polling.prototype.pause = function (e) {
			function pause() {
				c("paused"), t.readyState = "paused", e()
			}
			var t = this;
			if (this.readyState = "pausing", this.polling || !this.writable) {
				var r = 0;
				this.polling && (c("we are currently polling - waiting to pause"), r++, this.once("pollComplete", function () {
					c("pre-pause polling complete"), --r || pause()
				})), this.writable || (c("we are currently writing - waiting to pause"), r++, this.once("drain", function () {
					c("pre-pause writing complete"), --r || pause()
				}))
			} else pause()
		}, Polling.prototype.poll = function () {
			c("polling"), this.polling = !0, this.doPoll(), this.emit("poll")
		}, Polling.prototype.onData = function (e) {
			var t = this;
			c("polling got data %s", e);
			var r = function (e, r, n) {
				if ("opening" === t.readyState && t.onOpen(), "close" === e.type) return t.onClose(), !1;
				t.onPacket(e)
			};
			i.decodePayload(e, this.socket.binaryType, r), "closed" !== this.readyState && (this.polling = !1, this.emit("pollComplete"), "open" === this.readyState ? this.poll() : c('ignoring poll - transport state "%s"', this.readyState))
		}, Polling.prototype.doClose = function () {
			function close() {
				c("writing close packet"), e.write([{
					type: "close"
				}])
			}
			var e = this;
			"open" === this.readyState ? (c("transport open - closing"), close()) : (c("transport not open - deferring close"), this.once("open", close))
		}, Polling.prototype.write = function (e) {
			var t = this;
			this.writable = !1;
			var r = function () {
				t.writable = !0, t.emit("drain")
			};
			i.encodePayload(e, this.supportsBinary, function (e) {
				t.doWrite(e, r)
			})
		}, Polling.prototype.uri = function () {
			var e = this.query || {},
				t = this.secure ? "https" : "http",
				r = "";
			return !1 !== this.timestampRequests && (e[this.timestampParam] = a()), this.supportsBinary || e.sid || (e.b64 = 1), e = o.encode(e), this.port && ("https" === t && 443 !== Number(this.port) || "http" === t && 80 !== Number(this.port)) && (r = ":" + this.port), e.length && (e = "?" + e), t + "://" + (-1 !== this.hostname.indexOf(":") ? "[" + this.hostname + "]" : this.hostname) + r + this.path + e
		}
	}, function (e, t, r) {
		"use strict";

		function encode(e) {
			var t = "";
			do {
				t = o[e % i] + t, e = Math.floor(e / i)
			} while (e > 0);
			return t
		}

		function decode(e) {
			var t = 0;
			for (c = 0; c < e.length; c++) t = t * i + s[e.charAt(c)];
			return t
		}

		function yeast() {
			var e = encode(+new Date);
			return e !== n ? (a = 0, n = e) : e + "." + encode(a++)
		}
		for (var n, o = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_".split(""), i = 64, s = {}, a = 0, c = 0; c < i; c++) s[o[c]] = c;
		yeast.encode = encode, yeast.decode = decode, e.exports = yeast
	}, function (e, t) {
		var r = [].indexOf;
		e.exports = function (e, t) {
			if (r) return e.indexOf(t);
			for (var n = 0; n < e.length; ++n)
				if (e[n] === t) return n;
			return -1
		}
	}, function (e, t, r) {
		function Socket(e, t, r) {
			this.io = e, this.nsp = t, this.json = this, this.ids = 0, this.acks = {}, this.receiveBuffer = [], this.sendBuffer = [], this.connected = !1, this.disconnected = !0, r && r.query && (this.query = r.query), this.io.autoConnect && this.open()
		}
		var n = r(6),
			o = r(2),
			i = r(46),
			s = r(19),
			a = r(20),
			c = r(1)("socket.io-client:socket"),
			u = r(4);
		e.exports = Socket;
		var f = {
				connect: 1,
				connect_error: 1,
				connect_timeout: 1,
				connecting: 1,
				disconnect: 1,
				error: 1,
				reconnect: 1,
				reconnect_attempt: 1,
				reconnect_failed: 1,
				reconnect_error: 1,
				reconnecting: 1,
				ping: 1,
				pong: 1
			},
			h = o.prototype.emit;
		o(Socket.prototype), Socket.prototype.subEvents = function () {
			if (!this.subs) {
				var e = this.io;
				this.subs = [s(e, "open", a(this, "onopen")), s(e, "packet", a(this, "onpacket")), s(e, "close", a(this, "onclose"))]
			}
		}, Socket.prototype.open = Socket.prototype.connect = function () {
			return this.connected ? this : (this.subEvents(), this.io.open(), "open" === this.io.readyState && this.onopen(), this.emit("connecting"), this)
		}, Socket.prototype.send = function () {
			var e = i(arguments);
			return e.unshift("message"), this.emit.apply(this, e), this
		}, Socket.prototype.emit = function (e) {
			if (f.hasOwnProperty(e)) return h.apply(this, arguments), this;
			var t = i(arguments),
				r = {
					type: n.EVENT,
					data: t
				};
			return r.options = {}, r.options.compress = !this.flags || !1 !== this.flags.compress, "function" == typeof t[t.length - 1] && (c("emitting packet with ack id %d", this.ids), this.acks[this.ids] = t.pop(), r.id = this.ids++), this.connected ? this.packet(r) : this.sendBuffer.push(r), delete this.flags, this
		}, Socket.prototype.packet = function (e) {
			e.nsp = this.nsp, this.io.packet(e)
		}, Socket.prototype.onopen = function () {
			if (c("transport is open - connecting"), "/" !== this.nsp)
				if (this.query) {
					var e = "object" == typeof this.query ? u.encode(this.query) : this.query;
					c("sending connect packet with query %s", e), this.packet({
						type: n.CONNECT,
						query: e
					})
				} else this.packet({
					type: n.CONNECT
				})
		}, Socket.prototype.onclose = function (e) {
			c("close (%s)", e), this.connected = !1, this.disconnected = !0, delete this.id, this.emit("disconnect", e)
		}, Socket.prototype.onpacket = function (e) {
			if (e.nsp === this.nsp) switch (e.type) {
				case n.CONNECT:
					this.onconnect();
					break;
				case n.EVENT:
				case n.BINARY_EVENT:
					this.onevent(e);
					break;
				case n.ACK:
				case n.BINARY_ACK:
					this.onack(e);
					break;
				case n.DISCONNECT:
					this.ondisconnect();
					break;
				case n.ERROR:
					this.emit("error", e.data)
			}
		}, Socket.prototype.onevent = function (e) {
			var t = e.data || [];
			c("emitting event %j", t), null != e.id && (c("attaching ack callback to event"), t.push(this.ack(e.id))), this.connected ? h.apply(this, t) : this.receiveBuffer.push(t)
		}, Socket.prototype.ack = function (e) {
			var t = this,
				r = !1;
			return function () {
				if (!r) {
					r = !0;
					var o = i(arguments);
					c("sending ack %j", o), t.packet({
						type: n.ACK,
						id: e,
						data: o
					})
				}
			}
		}, Socket.prototype.onack = function (e) {
			var t = this.acks[e.id];
			"function" == typeof t ? (c("calling ack %s with %j", e.id, e.data), t.apply(this, e.data), delete this.acks[e.id]) : c("bad ack %s", e.id)
		}, Socket.prototype.onconnect = function () {
			this.connected = !0, this.disconnected = !1, this.emit("connect"), this.emitBuffered()
		}, Socket.prototype.emitBuffered = function () {
			var e;
			for (e = 0; e < this.receiveBuffer.length; e++) h.apply(this, this.receiveBuffer[e]);
			for (this.receiveBuffer = [], e = 0; e < this.sendBuffer.length; e++) this.packet(this.sendBuffer[e]);
			this.sendBuffer = []
		}, Socket.prototype.ondisconnect = function () {
			c("server disconnect (%s)", this.nsp), this.destroy(), this.onclose("io server disconnect")
		}, Socket.prototype.destroy = function () {
			if (this.subs) {
				for (var e = 0; e < this.subs.length; e++) this.subs[e].destroy();
				this.subs = null
			}
			this.io.destroy(this)
		}, Socket.prototype.close = Socket.prototype.disconnect = function () {
			return this.connected && (c("performing disconnect (%s)", this.nsp), this.packet({
				type: n.DISCONNECT
			})), this.destroy(), this.connected && this.onclose("io client disconnect"), this
		}, Socket.prototype.compress = function (e) {
			return this.flags = this.flags || {}, this.flags.compress = e, this
		}
	}, function (e, t) {
		function on(e, t, r) {
			return e.on(t, r), {
				destroy: function () {
					e.removeListener(t, r)
				}
			}
		}
		e.exports = on
	}, function (e, t) {
		var r = [].slice;
		e.exports = function (e, t) {
			if ("string" == typeof t && (t = e[t]), "function" != typeof t) throw new Error("bind() requires a function");
			var n = r.call(arguments, 2);
			return function () {
				return t.apply(e, n.concat(r.call(arguments)))
			}
		}
	}, function (e, t) {
		function EventEmitter() {
			this._events = this._events || {}, this._maxListeners = this._maxListeners || void 0
		}

		function isFunction(e) {
			return "function" == typeof e
		}

		function isNumber(e) {
			return "number" == typeof e
		}

		function isObject(e) {
			return "object" == typeof e && null !== e
		}

		function isUndefined(e) {
			return void 0 === e
		}
		e.exports = EventEmitter, EventEmitter.EventEmitter = EventEmitter, EventEmitter.prototype._events = void 0, EventEmitter.prototype._maxListeners = void 0, EventEmitter.defaultMaxListeners = 10, EventEmitter.prototype.setMaxListeners = function (e) {
			if (!isNumber(e) || e < 0 || isNaN(e)) throw TypeError("n must be a positive number");
			return this._maxListeners = e, this
		}, EventEmitter.prototype.emit = function (e) {
			var t, r, n, o, i, s;
			if (this._events || (this._events = {}), "error" === e && (!this._events.error || isObject(this._events.error) && !this._events.error.length)) {
				if ((t = arguments[1]) instanceof Error) throw t;
				var a = new Error('Uncaught, unspecified "error" event. (' + t + ")");
				throw a.context = t, a
			}
			if (r = this._events[e], isUndefined(r)) return !1;
			if (isFunction(r)) switch (arguments.length) {
				case 1:
					r.call(this);
					break;
				case 2:
					r.call(this, arguments[1]);
					break;
				case 3:
					r.call(this, arguments[1], arguments[2]);
					break;
				default:
					o = Array.prototype.slice.call(arguments, 1), r.apply(this, o)
			} else if (isObject(r))
				for (o = Array.prototype.slice.call(arguments, 1), s = r.slice(), n = s.length, i = 0; i < n; i++) s[i].apply(this, o);
			return !0
		}, EventEmitter.prototype.addListener = function (e, t) {
			var r;
			if (!isFunction(t)) throw TypeError("listener must be a function");
			return this._events || (this._events = {}), this._events.newListener && this.emit("newListener", e, isFunction(t.listener) ? t.listener : t), this._events[e] ? isObject(this._events[e]) ? this._events[e].push(t) : this._events[e] = [this._events[e], t] : this._events[e] = t, isObject(this._events[e]) && !this._events[e].warned && (r = isUndefined(this._maxListeners) ? EventEmitter.defaultMaxListeners : this._maxListeners) && r > 0 && this._events[e].length > r && (this._events[e].warned = !0, console.error("(node) warning: possible EventEmitter memory leak detected. %d listeners added. Use emitter.setMaxListeners() to increase limit.", this._events[e].length), "function" == typeof console.trace && console.trace()), this
		}, EventEmitter.prototype.on = EventEmitter.prototype.addListener, EventEmitter.prototype.once = function (e, t) {
			function g() {
				this.removeListener(e, g), r || (r = !0, t.apply(this, arguments))
			}
			if (!isFunction(t)) throw TypeError("listener must be a function");
			var r = !1;
			return g.listener = t, this.on(e, g), this
		}, EventEmitter.prototype.removeListener = function (e, t) {
			var r, n, o, i;
			if (!isFunction(t)) throw TypeError("listener must be a function");
			if (!this._events || !this._events[e]) return this;
			if (r = this._events[e], o = r.length, n = -1, r === t || isFunction(r.listener) && r.listener === t) delete this._events[e], this._events.removeListener && this.emit("removeListener", e, t);
			else if (isObject(r)) {
				for (i = o; i-- > 0;)
					if (r[i] === t || r[i].listener && r[i].listener === t) {
						n = i;
						break
					} if (n < 0) return this;
				1 === r.length ? (r.length = 0, delete this._events[e]) : r.splice(n, 1), this._events.removeListener && this.emit("removeListener", e, t)
			}
			return this
		}, EventEmitter.prototype.removeAllListeners = function (e) {
			var t, r;
			if (!this._events) return this;
			if (!this._events.removeListener) return 0 === arguments.length ? this._events = {} : this._events[e] && delete this._events[e], this;
			if (0 === arguments.length) {
				for (t in this._events) "removeListener" !== t && this.removeAllListeners(t);
				return this.removeAllListeners("removeListener"), this._events = {}, this
			}
			if (r = this._events[e], isFunction(r)) this.removeListener(e, r);
			else if (r)
				for (; r.length;) this.removeListener(e, r[r.length - 1]);
			return delete this._events[e], this
		}, EventEmitter.prototype.listeners = function (e) {
			return this._events && this._events[e] ? isFunction(this._events[e]) ? [this._events[e]] : this._events[e].slice() : []
		}, EventEmitter.prototype.listenerCount = function (e) {
			if (this._events) {
				var t = this._events[e];
				if (isFunction(t)) return 1;
				if (t) return t.length
			}
			return 0
		}, EventEmitter.listenerCount = function (e, t) {
			return e.listenerCount(t)
		}
	}, function (e, t, r) {
		"use strict";

		function _interopRequireDefault(e) {
			return e && e.__esModule ? e : {
				default: e
			}
		}

		function _classCallCheck(e, t) {
			if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
		}

		function _possibleConstructorReturn(e, t) {
			if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
			return !t || "object" != typeof t && "function" != typeof t ? e : t
		}

		function _inherits(e, t) {
			if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
			e.prototype = Object.create(t && t.prototype, {
				constructor: {
					value: e,
					enumerable: !1,
					writable: !0,
					configurable: !0
				}
			}), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
		}
		Object.defineProperty(t, "__esModule", {
			value: !0
		});
		var n = r(23),
			o = _interopRequireDefault(n),
			i = r(49),
			s = _interopRequireDefault(i),
			a = function (e) {
				function Recta(e) {
					var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1811;
					return _classCallCheck(this, Recta), _possibleConstructorReturn(this, (Recta.__proto__ || Object.getPrototypeOf(Recta)).call(this, new o.default({
						key: e,
						port: t
					})))
				}
				return _inherits(Recta, e), Recta
			}(s.default);
		t.default = a
	}, function (e, t, r) {
		"use strict";

		function _interopRequireDefault(e) {
			return e && e.__esModule ? e : {
				default: e
			}
		}

		function _classCallCheck(e, t) {
			if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
		}

		function _possibleConstructorReturn(e, t) {
			if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
			return !t || "object" != typeof t && "function" != typeof t ? e : t
		}

		function _inherits(e, t) {
			if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
			e.prototype = Object.create(t && t.prototype, {
				constructor: {
					value: e,
					enumerable: !1,
					writable: !0,
					configurable: !0
				}
			}), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
		}
		Object.defineProperty(t, "__esModule", {
			value: !0
		});
		var n = function () {
				function defineProperties(e, t) {
					for (var r = 0; r < t.length; r++) {
						var n = t[r];
						n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
					}
				}
				return function (e, t, r) {
					return t && defineProperties(e.prototype, t), r && defineProperties(e, r), e
				}
			}(),
			o = r(24),
			i = _interopRequireDefault(o),
			s = r(48),
			a = _interopRequireDefault(s),
			c = function (e) {
				function WebSocket(e) {
					var t = e.key,
						r = e.port;
					_classCallCheck(this, WebSocket);
					var n = _possibleConstructorReturn(this, (WebSocket.__proto__ || Object.getPrototypeOf(WebSocket)).call(this));
					return n.device = new i.default("ws://localhost:" + r, {
						transports: ["websocket"],
						query: "token=" + t,
						autoConnect: !1,
						reconnection: !1
					}), n.device.on("connect", function () {
						n.isOpen = !0, n.emit("open")
					}), n.device.on("disconnect", function () {
						n.isOpen = !1, n.emit("close")
					}), n.device.on("error", function (e) {
						n.isOpen && n.emit("error", e)
					}), n
				}
				return _inherits(WebSocket, e), n(WebSocket, [{
					key: "open",
					value: function () {
						var e = this;
						return new Promise(function (t, r) {
							if (e.isOpen) return t();
							e.device.open().once("connect", function () {
								return e.emit("open"), t()
							}).once("connect_timeout", function (e) {
								return r(e)
							}).once("connect_error", function (e) {
								return r(e)
							}).once("error", function (e) {
								return r(e)
							})
						})
					}
				}, {
					key: "close",
					value: function () {
						var e = this;
						return new Promise(function (t) {
							return e.isOpen ? (e.device.close(), e.emit("close"), t()) : t()
						})
					}
				}, {
					key: "write",
					value: function (e) {
						try {
							if (!this.isOpen) throw new Error("Adapter not opened");
							this.device.send(e)
						} catch (e) {
							this.emit("error", e)
						}
					}
				}]), WebSocket
			}(a.default);
		t.default = c
	}, function (e, t, r) {
		function lookup(e, t) {
			"object" == typeof e && (t = e, e = void 0), t = t || {};
			var r, o = n(e),
				c = o.source,
				u = o.id,
				f = o.path,
				h = a[u] && f in a[u].nsps,
				p = t.forceNew || t["force new connection"] || !1 === t.multiplex || h;
			return p ? (s("ignoring socket cache for %s", c), r = i(c, t)) : (a[u] || (s("new io instance for %s", c), a[u] = i(c, t)), r = a[u]), o.query && !t.query && (t.query = o.query), r.socket(o.path, t)
		}
		var n = r(25),
			o = r(6),
			i = r(13),
			s = r(1)("socket.io-client");
		e.exports = t = lookup;
		var a = t.managers = {};
		t.protocol = o.protocol, t.connect = lookup, t.Manager = r(13), t.Socket = r(18)
	}, function (e, t, r) {
		(function (t) {
			function url(e, r) {
				var i = e;
				r = r || t.location, null == e && (e = r.protocol + "//" + r.host), "string" == typeof e && ("/" === e.charAt(0) && (e = "/" === e.charAt(1) ? r.protocol + e : r.host + e), /^(https?|wss?):\/\//.test(e) || (o("protocol-less url %s", e), e = void 0 !== r ? r.protocol + "//" + e : "https://" + e), o("parse %s", e), i = n(e)), i.port || (/^(http|ws)$/.test(i.protocol) ? i.port = "80" : /^(http|ws)s$/.test(i.protocol) && (i.port = "443")), i.path = i.path || "/";
				var s = -1 !== i.host.indexOf(":"),
					a = s ? "[" + i.host + "]" : i.host;
				return i.id = i.protocol + "://" + a + ":" + i.port, i.href = i.protocol + "://" + a + (r && r.port === i.port ? "" : ":" + i.port), i
			}
			var n = r(9),
				o = r(1)("socket.io-client:url");
			e.exports = url
		}).call(t, r(0))
	}, function (e, t) {
		function defaultSetTimout() {
			throw new Error("setTimeout has not been defined")
		}

		function defaultClearTimeout() {
			throw new Error("clearTimeout has not been defined")
		}

		function runTimeout(e) {
			if (r === setTimeout) return setTimeout(e, 0);
			if ((r === defaultSetTimout || !r) && setTimeout) return r = setTimeout, setTimeout(e, 0);
			try {
				return r(e, 0)
			} catch (t) {
				try {
					return r.call(null, e, 0)
				} catch (t) {
					return r.call(this, e, 0)
				}
			}
		}

		function runClearTimeout(e) {
			if (n === clearTimeout) return clearTimeout(e);
			if ((n === defaultClearTimeout || !n) && clearTimeout) return n = clearTimeout, clearTimeout(e);
			try {
				return n(e)
			} catch (t) {
				try {
					return n.call(null, e)
				} catch (t) {
					return n.call(this, e)
				}
			}
		}

		function cleanUpNextTick() {
			a && i && (a = !1, i.length ? s = i.concat(s) : c = -1, s.length && drainQueue())
		}

		function drainQueue() {
			if (!a) {
				var e = runTimeout(cleanUpNextTick);
				a = !0;
				for (var t = s.length; t;) {
					for (i = s, s = []; ++c < t;) i && i[c].run();
					c = -1, t = s.length
				}
				i = null, a = !1, runClearTimeout(e)
			}
		}

		function Item(e, t) {
			this.fun = e, this.array = t
		}

		function noop() {}
		var r, n, o = e.exports = {};
		! function () {
			try {
				r = "function" == typeof setTimeout ? setTimeout : defaultSetTimout
			} catch (e) {
				r = defaultSetTimout
			}
			try {
				n = "function" == typeof clearTimeout ? clearTimeout : defaultClearTimeout
			} catch (e) {
				n = defaultClearTimeout
			}
		}();
		var i, s = [],
			a = !1,
			c = -1;
		o.nextTick = function (e) {
			var t = new Array(arguments.length - 1);
			if (arguments.length > 1)
				for (var r = 1; r < arguments.length; r++) t[r - 1] = arguments[r];
			s.push(new Item(e, t)), 1 !== s.length || a || runTimeout(drainQueue)
		}, Item.prototype.run = function () {
			this.fun.apply(null, this.array)
		}, o.title = "browser", o.browser = !0, o.env = {}, o.argv = [], o.version = "", o.versions = {}, o.on = noop, o.addListener = noop, o.once = noop, o.off = noop, o.removeListener = noop, o.removeAllListeners = noop, o.emit = noop, o.prependListener = noop, o.prependOnceListener = noop, o.listeners = function (e) {
			return []
		}, o.binding = function (e) {
			throw new Error("process.binding is not supported")
		}, o.cwd = function () {
			return "/"
		}, o.chdir = function (e) {
			throw new Error("process.chdir is not supported")
		}, o.umask = function () {
			return 0
		}
	}, function (e, t, r) {
		function selectColor(e) {
			var r, n = 0;
			for (r in e) n = (n << 5) - n + e.charCodeAt(r), n |= 0;
			return t.colors[Math.abs(n) % t.colors.length]
		}

		function createDebug(e) {
			function debug() {
				if (debug.enabled) {
					var e = debug,
						r = +new Date,
						o = r - (n || r);
					e.diff = o, e.prev = n, e.curr = r, n = r;
					for (var i = new Array(arguments.length), s = 0; s < i.length; s++) i[s] = arguments[s];
					i[0] = t.coerce(i[0]), "string" != typeof i[0] && i.unshift("%O");
					var a = 0;
					i[0] = i[0].replace(/%([a-zA-Z%])/g, function (r, n) {
						if ("%%" === r) return r;
						a++;
						var o = t.formatters[n];
						if ("function" == typeof o) {
							var s = i[a];
							r = o.call(e, s), i.splice(a, 1), a--
						}
						return r
					}), t.formatArgs.call(e, i);
					(debug.log || t.log || console.log.bind(console)).apply(e, i)
				}
			}
			return debug.namespace = e, debug.enabled = t.enabled(e), debug.useColors = t.useColors(), debug.color = selectColor(e), "function" == typeof t.init && t.init(debug), debug
		}

		function enable(e) {
			t.save(e), t.names = [], t.skips = [];
			for (var r = ("string" == typeof e ? e : "").split(/[\s,]+/), n = r.length, o = 0; o < n; o++) r[o] && (e = r[o].replace(/\*/g, ".*?"), "-" === e[0] ? t.skips.push(new RegExp("^" + e.substr(1) + "$")) : t.names.push(new RegExp("^" + e + "$")))
		}

		function disable() {
			t.enable("")
		}

		function enabled(e) {
			var r, n;
			for (r = 0, n = t.skips.length; r < n; r++)
				if (t.skips[r].test(e)) return !1;
			for (r = 0, n = t.names.length; r < n; r++)
				if (t.names[r].test(e)) return !0;
			return !1
		}

		function coerce(e) {
			return e instanceof Error ? e.stack || e.message : e
		}
		t = e.exports = createDebug.debug = createDebug.default = createDebug, t.coerce = coerce, t.disable = disable, t.enable = enable, t.enabled = enabled, t.humanize = r(28), t.names = [], t.skips = [], t.formatters = {};
		var n
	}, function (e, t) {
		function parse(e) {
			if (e = String(e), !(e.length > 100)) {
				var t = /^((?:\d+)?\.?\d+) *(milliseconds?|msecs?|ms|seconds?|secs?|s|minutes?|mins?|m|hours?|hrs?|h|days?|d|years?|yrs?|y)?$/i.exec(e);
				if (t) {
					var a = parseFloat(t[1]);
					switch ((t[2] || "ms").toLowerCase()) {
						case "years":
						case "year":
						case "yrs":
						case "yr":
						case "y":
							return a * s;
						case "days":
						case "day":
						case "d":
							return a * i;
						case "hours":
						case "hour":
						case "hrs":
						case "hr":
						case "h":
							return a * o;
						case "minutes":
						case "minute":
						case "mins":
						case "min":
						case "m":
							return a * n;
						case "seconds":
						case "second":
						case "secs":
						case "sec":
						case "s":
							return a * r;
						case "milliseconds":
						case "millisecond":
						case "msecs":
						case "msec":
						case "ms":
							return a;
						default:
							return
					}
				}
			}
		}

		function fmtShort(e) {
			return e >= i ? Math.round(e / i) + "d" : e >= o ? Math.round(e / o) + "h" : e >= n ? Math.round(e / n) + "m" : e >= r ? Math.round(e / r) + "s" : e + "ms"
		}

		function fmtLong(e) {
			return plural(e, i, "day") || plural(e, o, "hour") || plural(e, n, "minute") || plural(e, r, "second") || e + " ms"
		}

		function plural(e, t, r) {
			if (!(e < t)) return e < 1.5 * t ? Math.floor(e / t) + " " + r : Math.ceil(e / t) + " " + r + "s"
		}
		var r = 1e3,
			n = 60 * r,
			o = 60 * n,
			i = 24 * o,
			s = 365.25 * i;
		e.exports = function (e, t) {
			t = t || {};
			var r = typeof e;
			if ("string" === r && e.length > 0) return parse(e);
			if ("number" === r && !1 === isNaN(e)) return t.long ? fmtLong(e) : fmtShort(e);
			throw new Error("val is not a non-empty string or a valid number. val=" + JSON.stringify(e))
		}
	}, function (e, t, r) {
		(function (e) {
			function _deconstructPacket(e, t) {
				if (!e) return e;
				if (o(e)) {
					var r = {
						_placeholder: !0,
						num: t.length
					};
					return t.push(e), r
				}
				if (n(e)) {
					for (var i = new Array(e.length), s = 0; s < e.length; s++) i[s] = _deconstructPacket(e[s], t);
					return i
				}
				if ("object" == typeof e && !(e instanceof Date)) {
					var i = {};
					for (var a in e) i[a] = _deconstructPacket(e[a], t);
					return i
				}
				return e
			}

			function _reconstructPacket(e, t) {
				if (!e) return e;
				if (e && e._placeholder) return t[e.num];
				if (n(e))
					for (var r = 0; r < e.length; r++) e[r] = _reconstructPacket(e[r], t);
				else if ("object" == typeof e)
					for (var o in e) e[o] = _reconstructPacket(e[o], t);
				return e
			}
			var n = r(11),
				o = r(12),
				i = Object.prototype.toString,
				s = "function" == typeof e.Blob || "[object BlobConstructor]" === i.call(e.Blob),
				a = "function" == typeof e.File || "[object FileConstructor]" === i.call(e.File);
			t.deconstructPacket = function (e) {
				var t = [],
					r = e.data,
					n = e;
				return n.data = _deconstructPacket(r, t), n.attachments = t.length, {
					packet: n,
					buffers: t
				}
			}, t.reconstructPacket = function (e, t) {
				return e.data = _reconstructPacket(e.data, t), e.attachments = void 0, e
			}, t.removeBlobs = function (e, t) {
				function _removeBlobs(e, c, u) {
					if (!e) return e;
					if (s && e instanceof Blob || a && e instanceof File) {
						r++;
						var f = new FileReader;
						f.onload = function () {
							u ? u[c] = this.result : i = this.result, --r || t(i)
						}, f.readAsArrayBuffer(e)
					} else if (n(e))
						for (var h = 0; h < e.length; h++) _removeBlobs(e[h], h, e);
					else if ("object" == typeof e && !o(e))
						for (var p in e) _removeBlobs(e[p], p, e)
				}
				var r = 0,
					i = e;
				_removeBlobs(i), r || t(i)
			}
		}).call(t, r(0))
	}, function (e, t, r) {
		e.exports = r(31)
	}, function (e, t, r) {
		e.exports = r(32), e.exports.parser = r(3)
	}, function (e, t, r) {
		(function (t) {
			function Socket(e, r) {
				if (!(this instanceof Socket)) return new Socket(e, r);
				r = r || {}, e && "object" == typeof e && (r = e, e = null), e ? (e = c(e), r.hostname = e.host, r.secure = "https" === e.protocol || "wss" === e.protocol, r.port = e.port, e.query && (r.query = e.query)) : r.host && (r.hostname = c(r.host).host), this.secure = null != r.secure ? r.secure : t.location && "https:" === location.protocol, r.hostname && !r.port && (r.port = this.secure ? "443" : "80"), this.agent = r.agent || !1, this.hostname = r.hostname || (t.location ? location.hostname : "localhost"), this.port = r.port || (t.location && location.port ? location.port : this.secure ? 443 : 80), this.query = r.query || {}, "string" == typeof this.query && (this.query = f.decode(this.query)), this.upgrade = !1 !== r.upgrade, this.path = (r.path || "/engine.io").replace(/\/$/, "") + "/", this.forceJSONP = !!r.forceJSONP, this.jsonp = !1 !== r.jsonp, this.forceBase64 = !!r.forceBase64, this.enablesXDR = !!r.enablesXDR, this.timestampParam = r.timestampParam || "t", this.timestampRequests = r.timestampRequests, this.transports = r.transports || ["polling", "websocket"], this.transportOptions = r.transportOptions || {}, this.readyState = "", this.writeBuffer = [], this.prevBufferLen = 0, this.policyPort = r.policyPort || 843, this.rememberUpgrade = r.rememberUpgrade || !1, this.binaryType = null, this.onlyBinaryUpgrades = r.onlyBinaryUpgrades, this.perMessageDeflate = !1 !== r.perMessageDeflate && (r.perMessageDeflate || {}), !0 === this.perMessageDeflate && (this.perMessageDeflate = {}), this.perMessageDeflate && null == this.perMessageDeflate.threshold && (this.perMessageDeflate.threshold = 1024), this.pfx = r.pfx || null, this.key = r.key || null, this.passphrase = r.passphrase || null, this.cert = r.cert || null, this.ca = r.ca || null, this.ciphers = r.ciphers || null, this.rejectUnauthorized = void 0 === r.rejectUnauthorized || r.rejectUnauthorized, this.forceNode = !!r.forceNode;
				var n = "object" == typeof t && t;
				n.global === n && (r.extraHeaders && Object.keys(r.extraHeaders).length > 0 && (this.extraHeaders = r.extraHeaders), r.localAddress && (this.localAddress = r.localAddress)), this.id = null, this.upgrades = null, this.pingInterval = null, this.pingTimeout = null, this.pingIntervalTimer = null, this.pingTimeoutTimer = null, this.open()
			}

			function clone(e) {
				var t = {};
				for (var r in e) e.hasOwnProperty(r) && (t[r] = e[r]);
				return t
			}
			var n = r(14),
				o = r(2),
				i = r(1)("engine.io-client:socket"),
				s = r(17),
				a = r(3),
				c = r(9),
				u = r(45),
				f = r(4);
			e.exports = Socket, Socket.priorWebsocketSuccess = !1, o(Socket.prototype), Socket.protocol = a.protocol, Socket.Socket = Socket, Socket.Transport = r(8), Socket.transports = r(14), Socket.parser = r(3), Socket.prototype.createTransport = function (e) {
				i('creating transport "%s"', e);
				var t = clone(this.query);
				t.EIO = a.protocol, t.transport = e;
				var r = this.transportOptions[e] || {};
				return this.id && (t.sid = this.id), new n[e]({
					query: t,
					socket: this,
					agent: r.agent || this.agent,
					hostname: r.hostname || this.hostname,
					port: r.port || this.port,
					secure: r.secure || this.secure,
					path: r.path || this.path,
					forceJSONP: r.forceJSONP || this.forceJSONP,
					jsonp: r.jsonp || this.jsonp,
					forceBase64: r.forceBase64 || this.forceBase64,
					enablesXDR: r.enablesXDR || this.enablesXDR,
					timestampRequests: r.timestampRequests || this.timestampRequests,
					timestampParam: r.timestampParam || this.timestampParam,
					policyPort: r.policyPort || this.policyPort,
					pfx: r.pfx || this.pfx,
					key: r.key || this.key,
					passphrase: r.passphrase || this.passphrase,
					cert: r.cert || this.cert,
					ca: r.ca || this.ca,
					ciphers: r.ciphers || this.ciphers,
					rejectUnauthorized: r.rejectUnauthorized || this.rejectUnauthorized,
					perMessageDeflate: r.perMessageDeflate || this.perMessageDeflate,
					extraHeaders: r.extraHeaders || this.extraHeaders,
					forceNode: r.forceNode || this.forceNode,
					localAddress: r.localAddress || this.localAddress,
					requestTimeout: r.requestTimeout || this.requestTimeout,
					protocols: r.protocols || void 0
				})
			}, Socket.prototype.open = function () {
				var e;
				if (this.rememberUpgrade && Socket.priorWebsocketSuccess && -1 !== this.transports.indexOf("websocket")) e = "websocket";
				else {
					if (0 === this.transports.length) {
						var t = this;
						return void setTimeout(function () {
							t.emit("error", "No transports available")
						}, 0)
					}
					e = this.transports[0]
				}
				this.readyState = "opening";
				try {
					e = this.createTransport(e)
				} catch (e) {
					return this.transports.shift(), void this.open()
				}
				e.open(), this.setTransport(e)
			}, Socket.prototype.setTransport = function (e) {
				i("setting transport %s", e.name);
				var t = this;
				this.transport && (i("clearing existing transport %s", this.transport.name), this.transport.removeAllListeners()), this.transport = e, e.on("drain", function () {
					t.onDrain()
				}).on("packet", function (e) {
					t.onPacket(e)
				}).on("error", function (e) {
					t.onError(e)
				}).on("close", function () {
					t.onClose("transport close")
				})
			}, Socket.prototype.probe = function (e) {
				function onTransportOpen() {
					if (n.onlyBinaryUpgrades) {
						var o = !this.supportsBinary && n.transport.supportsBinary;
						r = r || o
					}
					r || (i('probe transport "%s" opened', e), t.send([{
						type: "ping",
						data: "probe"
					}]), t.once("packet", function (o) {
						if (!r)
							if ("pong" === o.type && "probe" === o.data) {
								if (i('probe transport "%s" pong', e), n.upgrading = !0, n.emit("upgrading", t), !t) return;
								Socket.priorWebsocketSuccess = "websocket" === t.name, i('pausing current transport "%s"', n.transport.name), n.transport.pause(function () {
									r || "closed" !== n.readyState && (i("changing transport and sending upgrade packet"), cleanup(), n.setTransport(t), t.send([{
										type: "upgrade"
									}]), n.emit("upgrade", t), t = null, n.upgrading = !1, n.flush())
								})
							} else {
								i('probe transport "%s" failed', e);
								var s = new Error("probe error");
								s.transport = t.name, n.emit("upgradeError", s)
							}
					}))
				}

				function freezeTransport() {
					r || (r = !0, cleanup(), t.close(), t = null)
				}

				function onerror(r) {
					var o = new Error("probe error: " + r);
					o.transport = t.name, freezeTransport(), i('probe transport "%s" failed because of error: %s', e, r), n.emit("upgradeError", o)
				}

				function onTransportClose() {
					onerror("transport closed")
				}

				function onclose() {
					onerror("socket closed")
				}

				function onupgrade(e) {
					t && e.name !== t.name && (i('"%s" works - aborting "%s"', e.name, t.name), freezeTransport())
				}

				function cleanup() {
					t.removeListener("open", onTransportOpen), t.removeListener("error", onerror), t.removeListener("close", onTransportClose), n.removeListener("close", onclose), n.removeListener("upgrading", onupgrade)
				}
				i('probing transport "%s"', e);
				var t = this.createTransport(e, {
						probe: 1
					}),
					r = !1,
					n = this;
				Socket.priorWebsocketSuccess = !1, t.once("open", onTransportOpen), t.once("error", onerror), t.once("close", onTransportClose), this.once("close", onclose), this.once("upgrading", onupgrade), t.open()
			}, Socket.prototype.onOpen = function () {
				if (i("socket open"), this.readyState = "open", Socket.priorWebsocketSuccess = "websocket" === this.transport.name, this.emit("open"), this.flush(), "open" === this.readyState && this.upgrade && this.transport.pause) {
					i("starting upgrade probes");
					for (var e = 0, t = this.upgrades.length; e < t; e++) this.probe(this.upgrades[e])
				}
			}, Socket.prototype.onPacket = function (e) {
				if ("opening" === this.readyState || "open" === this.readyState || "closing" === this.readyState) switch (i('socket receive: type "%s", data "%s"', e.type, e.data), this.emit("packet", e), this.emit("heartbeat"), e.type) {
					case "open":
						this.onHandshake(u(e.data));
						break;
					case "pong":
						this.setPing(), this.emit("pong");
						break;
					case "error":
						var t = new Error("server error");
						t.code = e.data, this.onError(t);
						break;
					case "message":
						this.emit("data", e.data), this.emit("message", e.data)
				} else i('packet received with socket readyState "%s"', this.readyState)
			}, Socket.prototype.onHandshake = function (e) {
				this.emit("handshake", e), this.id = e.sid, this.transport.query.sid = e.sid, this.upgrades = this.filterUpgrades(e.upgrades), this.pingInterval = e.pingInterval, this.pingTimeout = e.pingTimeout, this.onOpen(), "closed" !== this.readyState && (this.setPing(), this.removeListener("heartbeat", this.onHeartbeat), this.on("heartbeat", this.onHeartbeat))
			}, Socket.prototype.onHeartbeat = function (e) {
				clearTimeout(this.pingTimeoutTimer);
				var t = this;
				t.pingTimeoutTimer = setTimeout(function () {
					"closed" !== t.readyState && t.onClose("ping timeout")
				}, e || t.pingInterval + t.pingTimeout)
			}, Socket.prototype.setPing = function () {
				var e = this;
				clearTimeout(e.pingIntervalTimer), e.pingIntervalTimer = setTimeout(function () {
					i("writing ping packet - expecting pong within %sms", e.pingTimeout), e.ping(), e.onHeartbeat(e.pingTimeout)
				}, e.pingInterval)
			}, Socket.prototype.ping = function () {
				var e = this;
				this.sendPacket("ping", function () {
					e.emit("ping")
				})
			}, Socket.prototype.onDrain = function () {
				this.writeBuffer.splice(0, this.prevBufferLen), this.prevBufferLen = 0, 0 === this.writeBuffer.length ? this.emit("drain") : this.flush()
			}, Socket.prototype.flush = function () {
				"closed" !== this.readyState && this.transport.writable && !this.upgrading && this.writeBuffer.length && (i("flushing %d packets in socket", this.writeBuffer.length), this.transport.send(this.writeBuffer), this.prevBufferLen = this.writeBuffer.length, this.emit("flush"))
			}, Socket.prototype.write = Socket.prototype.send = function (e, t, r) {
				return this.sendPacket("message", e, t, r), this
			}, Socket.prototype.sendPacket = function (e, t, r, n) {
				if ("function" == typeof t && (n = t, t = void 0), "function" == typeof r && (n = r, r = null), "closing" !== this.readyState && "closed" !== this.readyState) {
					r = r || {}, r.compress = !1 !== r.compress;
					var o = {
						type: e,
						data: t,
						options: r
					};
					this.emit("packetCreate", o), this.writeBuffer.push(o), n && this.once("flush", n), this.flush()
				}
			}, Socket.prototype.close = function () {
				function close() {
					e.onClose("forced close"), i("socket closing - telling transport to close"), e.transport.close()
				}

				function cleanupAndClose() {
					e.removeListener("upgrade", cleanupAndClose), e.removeListener("upgradeError", cleanupAndClose), close()
				}

				function waitForUpgrade() {
					e.once("upgrade", cleanupAndClose), e.once("upgradeError", cleanupAndClose)
				}
				if ("opening" === this.readyState || "open" === this.readyState) {
					this.readyState = "closing";
					var e = this;
					this.writeBuffer.length ? this.once("drain", function () {
						this.upgrading ? waitForUpgrade() : close()
					}) : this.upgrading ? waitForUpgrade() : close()
				}
				return this
			}, Socket.prototype.onError = function (e) {
				i("socket error %j", e), Socket.priorWebsocketSuccess = !1, this.emit("error", e), this.onClose("transport error", e)
			}, Socket.prototype.onClose = function (e, t) {
				if ("opening" === this.readyState || "open" === this.readyState || "closing" === this.readyState) {
					i('socket close with reason: "%s"', e);
					var r = this;
					clearTimeout(this.pingIntervalTimer), clearTimeout(this.pingTimeoutTimer), this.transport.removeAllListeners("close"), this.transport.close(), this.transport.removeAllListeners(), this.readyState = "closed", this.id = null, this.emit("close", e, t), r.writeBuffer = [], r.prevBufferLen = 0
				}
			}, Socket.prototype.filterUpgrades = function (e) {
				for (var t = [], r = 0, n = e.length; r < n; r++) ~s(this.transports, e[r]) && t.push(e[r]);
				return t
			}
		}).call(t, r(0))
	}, function (e, t) {
		try {
			e.exports = "undefined" != typeof XMLHttpRequest && "withCredentials" in new XMLHttpRequest
		} catch (t) {
			e.exports = !1
		}
	}, function (e, t, r) {
		(function (t) {
			function empty() {}

			function XHR(e) {
				if (o.call(this, e), this.requestTimeout = e.requestTimeout, this.extraHeaders = e.extraHeaders, t.location) {
					var r = "https:" === location.protocol,
						n = location.port;
					n || (n = r ? 443 : 80), this.xd = e.hostname !== t.location.hostname || n !== e.port, this.xs = e.secure !== r
				}
			}

			function Request(e) {
				this.method = e.method || "GET", this.uri = e.uri, this.xd = !!e.xd, this.xs = !!e.xs, this.async = !1 !== e.async, this.data = void 0 !== e.data ? e.data : null, this.agent = e.agent, this.isBinary = e.isBinary, this.supportsBinary = e.supportsBinary, this.enablesXDR = e.enablesXDR, this.requestTimeout = e.requestTimeout, this.pfx = e.pfx, this.key = e.key, this.passphrase = e.passphrase, this.cert = e.cert, this.ca = e.ca, this.ciphers = e.ciphers, this.rejectUnauthorized = e.rejectUnauthorized, this.extraHeaders = e.extraHeaders, this.create()
			}

			function unloadHandler() {
				for (var e in Request.requests) Request.requests.hasOwnProperty(e) && Request.requests[e].abort()
			}
			var n = r(7),
				o = r(15),
				i = r(2),
				s = r(5),
				a = r(1)("engine.io-client:polling-xhr");
			e.exports = XHR, e.exports.Request = Request, s(XHR, o), XHR.prototype.supportsBinary = !0, XHR.prototype.request = function (e) {
				return e = e || {}, e.uri = this.uri(), e.xd = this.xd, e.xs = this.xs, e.agent = this.agent || !1, e.supportsBinary = this.supportsBinary, e.enablesXDR = this.enablesXDR, e.pfx = this.pfx, e.key = this.key, e.passphrase = this.passphrase, e.cert = this.cert, e.ca = this.ca, e.ciphers = this.ciphers, e.rejectUnauthorized = this.rejectUnauthorized, e.requestTimeout = this.requestTimeout, e.extraHeaders = this.extraHeaders, new Request(e)
			}, XHR.prototype.doWrite = function (e, t) {
				var r = "string" != typeof e && void 0 !== e,
					n = this.request({
						method: "POST",
						data: e,
						isBinary: r
					}),
					o = this;
				n.on("success", t), n.on("error", function (e) {
					o.onError("xhr post error", e)
				}), this.sendXhr = n
			}, XHR.prototype.doPoll = function () {
				a("xhr poll");
				var e = this.request(),
					t = this;
				e.on("data", function (e) {
					t.onData(e)
				}), e.on("error", function (e) {
					t.onError("xhr poll error", e)
				}), this.pollXhr = e
			}, i(Request.prototype), Request.prototype.create = function () {
				var e = {
					agent: this.agent,
					xdomain: this.xd,
					xscheme: this.xs,
					enablesXDR: this.enablesXDR
				};
				e.pfx = this.pfx, e.key = this.key, e.passphrase = this.passphrase, e.cert = this.cert, e.ca = this.ca, e.ciphers = this.ciphers, e.rejectUnauthorized = this.rejectUnauthorized;
				var r = this.xhr = new n(e),
					o = this;
				try {
					a("xhr open %s: %s", this.method, this.uri), r.open(this.method, this.uri, this.async);
					try {
						if (this.extraHeaders) {
							r.setDisableHeaderCheck && r.setDisableHeaderCheck(!0);
							for (var i in this.extraHeaders) this.extraHeaders.hasOwnProperty(i) && r.setRequestHeader(i, this.extraHeaders[i])
						}
					} catch (e) {}
					if ("POST" === this.method) try {
						this.isBinary ? r.setRequestHeader("Content-type", "application/octet-stream") : r.setRequestHeader("Content-type", "text/plain;charset=UTF-8")
					} catch (e) {}
					try {
						r.setRequestHeader("Accept", "*/*")
					} catch (e) {}
					"withCredentials" in r && (r.withCredentials = !0), this.requestTimeout && (r.timeout = this.requestTimeout), this.hasXDR() ? (r.onload = function () {
						o.onLoad()
					}, r.onerror = function () {
						o.onError(r.responseText)
					}) : r.onreadystatechange = function () {
						if (2 === r.readyState) {
							var e;
							try {
								e = r.getResponseHeader("Content-Type")
							} catch (e) {}
							"application/octet-stream" === e && (r.responseType = "arraybuffer")
						}
						4 === r.readyState && (200 === r.status || 1223 === r.status ? o.onLoad() : setTimeout(function () {
							o.onError(r.status)
						}, 0))
					}, a("xhr data %s", this.data), r.send(this.data)
				} catch (e) {
					return void setTimeout(function () {
						o.onError(e)
					}, 0)
				}
				t.document && (this.index = Request.requestsCount++, Request.requests[this.index] = this)
			}, Request.prototype.onSuccess = function () {
				this.emit("success"), this.cleanup()
			}, Request.prototype.onData = function (e) {
				this.emit("data", e), this.onSuccess()
			}, Request.prototype.onError = function (e) {
				this.emit("error", e), this.cleanup(!0)
			}, Request.prototype.cleanup = function (e) {
				if (void 0 !== this.xhr && null !== this.xhr) {
					if (this.hasXDR() ? this.xhr.onload = this.xhr.onerror = empty : this.xhr.onreadystatechange = empty, e) try {
						this.xhr.abort()
					} catch (e) {}
					t.document && delete Request.requests[this.index], this.xhr = null
				}
			}, Request.prototype.onLoad = function () {
				var e;
				try {
					var t;
					try {
						t = this.xhr.getResponseHeader("Content-Type")
					} catch (e) {}
					e = "application/octet-stream" === t ? this.xhr.response || this.xhr.responseText : this.xhr.responseText
				} catch (e) {
					this.onError(e)
				}
				null != e && this.onData(e)
			}, Request.prototype.hasXDR = function () {
				return void 0 !== t.XDomainRequest && !this.xs && this.enablesXDR
			}, Request.prototype.abort = function () {
				this.cleanup()
			}, Request.requestsCount = 0, Request.requests = {}, t.document && (t.attachEvent ? t.attachEvent("onunload", unloadHandler) : t.addEventListener && t.addEventListener("beforeunload", unloadHandler, !1))
		}).call(t, r(0))
	}, function (e, t) {
		e.exports = Object.keys || function (e) {
			var t = [],
				r = Object.prototype.hasOwnProperty;
			for (var n in e) r.call(e, n) && t.push(n);
			return t
		}
	}, function (e, t) {
		e.exports = function (e, t, r) {
			var n = e.byteLength;
			if (t = t || 0, r = r || n, e.slice) return e.slice(t, r);
			if (t < 0 && (t += n), r < 0 && (r += n), r > n && (r = n), t >= n || t >= r || 0 === n) return new ArrayBuffer(0);
			for (var o = new Uint8Array(e), i = new Uint8Array(r - t), s = t, a = 0; s < r; s++, a++) i[a] = o[s];
			return i.buffer
		}
	}, function (e, t) {
		function after(e, t, r) {
			function proxy(e, o) {
				if (proxy.count <= 0) throw new Error("after called too many times");
				--proxy.count, e ? (n = !0, t(e), t = r) : 0 !== proxy.count || n || t(null, o)
			}
			var n = !1;
			return r = r || noop, proxy.count = e, 0 === e ? t() : proxy
		}

		function noop() {}
		e.exports = after
	}, function (e, t, r) {
		(function (e, n) {
			var o;
			! function (i) {
				function ucs2decode(e) {
					for (var t, r, n = [], o = 0, i = e.length; o < i;) t = e.charCodeAt(o++), t >= 55296 && t <= 56319 && o < i ? (r = e.charCodeAt(o++), 56320 == (64512 & r) ? n.push(((1023 & t) << 10) + (1023 & r) + 65536) : (n.push(t), o--)) : n.push(t);
					return n
				}

				function ucs2encode(e) {
					for (var t, r = e.length, n = -1, o = ""; ++n < r;) t = e[n], t > 65535 && (t -= 65536, o += h(t >>> 10 & 1023 | 55296), t = 56320 | 1023 & t), o += h(t);
					return o
				}

				function checkScalarValue(e, t) {
					if (e >= 55296 && e <= 57343) {
						if (t) throw Error("Lone surrogate U+" + e.toString(16).toUpperCase() + " is not a scalar value");
						return !1
					}
					return !0
				}

				function createByte(e, t) {
					return h(e >> t & 63 | 128)
				}

				function encodeCodePoint(e, t) {
					if (0 == (4294967168 & e)) return h(e);
					var r = "";
					return 0 == (4294965248 & e) ? r = h(e >> 6 & 31 | 192) : 0 == (4294901760 & e) ? (checkScalarValue(e, t) || (e = 65533), r = h(e >> 12 & 15 | 224), r += createByte(e, 6)) : 0 == (4292870144 & e) && (r = h(e >> 18 & 7 | 240), r += createByte(e, 12), r += createByte(e, 6)), r += h(63 & e | 128)
				}

				function utf8encode(e, t) {
					t = t || {};
					for (var r, n = !1 !== t.strict, o = ucs2decode(e), i = o.length, s = -1, a = ""; ++s < i;) r = o[s], a += encodeCodePoint(r, n);
					return a
				}

				function readContinuationByte() {
					if (f >= u) throw Error("Invalid byte index");
					var e = 255 & c[f];
					if (f++, 128 == (192 & e)) return 63 & e;
					throw Error("Invalid continuation byte")
				}

				function decodeSymbol(e) {
					var t, r, n, o, i;
					if (f > u) throw Error("Invalid byte index");
					if (f == u) return !1;
					if (t = 255 & c[f], f++, 0 == (128 & t)) return t;
					if (192 == (224 & t)) {
						if (r = readContinuationByte(), (i = (31 & t) << 6 | r) >= 128) return i;
						throw Error("Invalid continuation byte")
					}
					if (224 == (240 & t)) {
						if (r = readContinuationByte(), n = readContinuationByte(), (i = (15 & t) << 12 | r << 6 | n) >= 2048) return checkScalarValue(i, e) ? i : 65533;
						throw Error("Invalid continuation byte")
					}
					if (240 == (248 & t) && (r = readContinuationByte(), n = readContinuationByte(), o = readContinuationByte(), (i = (7 & t) << 18 | r << 12 | n << 6 | o) >= 65536 && i <= 1114111)) return i;
					throw Error("Invalid UTF-8 detected")
				}

				function utf8decode(e, t) {
					t = t || {};
					var r = !1 !== t.strict;
					c = ucs2decode(e), u = c.length, f = 0;
					for (var n, o = []; !1 !== (n = decodeSymbol(r));) o.push(n);
					return ucs2encode(o)
				}
				var s = "object" == typeof t && t,
					a = ("object" == typeof e && e && e.exports, "object" == typeof n && n);
				var c, u, f, h = String.fromCharCode,
					p = {
						version: "2.1.2",
						encode: utf8encode,
						decode: utf8decode
					};
				void 0 !== (o = function () {
					return p
				}.call(t, r, t, e)) && (e.exports = o)
			}()
		}).call(t, r(39)(e), r(0))
	}, function (e, t) {
		e.exports = function (e) {
			return e.webpackPolyfill || (e.deprecate = function () {}, e.paths = [], e.children || (e.children = []), Object.defineProperty(e, "loaded", {
				enumerable: !0,
				get: function () {
					return e.l
				}
			}), Object.defineProperty(e, "id", {
				enumerable: !0,
				get: function () {
					return e.i
				}
			}), e.webpackPolyfill = 1), e
		}
	}, function (e, t) {
		! function () {
			"use strict";
			for (var e = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", r = new Uint8Array(256), n = 0; n < e.length; n++) r[e.charCodeAt(n)] = n;
			t.encode = function (t) {
				var r, n = new Uint8Array(t),
					o = n.length,
					i = "";
				for (r = 0; r < o; r += 3) i += e[n[r] >> 2], i += e[(3 & n[r]) << 4 | n[r + 1] >> 4], i += e[(15 & n[r + 1]) << 2 | n[r + 2] >> 6], i += e[63 & n[r + 2]];
				return o % 3 == 2 ? i = i.substring(0, i.length - 1) + "=" : o % 3 == 1 && (i = i.substring(0, i.length - 2) + "=="), i
			}, t.decode = function (e) {
				var t, n, o, i, s, a = .75 * e.length,
					c = e.length,
					u = 0;
				"=" === e[e.length - 1] && (a--, "=" === e[e.length - 2] && a--);
				var f = new ArrayBuffer(a),
					h = new Uint8Array(f);
				for (t = 0; t < c; t += 4) n = r[e.charCodeAt(t)], o = r[e.charCodeAt(t + 1)], i = r[e.charCodeAt(t + 2)], s = r[e.charCodeAt(t + 3)], h[u++] = n << 2 | o >> 4, h[u++] = (15 & o) << 4 | i >> 2, h[u++] = (3 & i) << 6 | 63 & s;
				return f
			}
		}()
	}, function (e, t, r) {
		(function (t) {
			function mapArrayBufferViews(e) {
				for (var t = 0; t < e.length; t++) {
					var r = e[t];
					if (r.buffer instanceof ArrayBuffer) {
						var n = r.buffer;
						if (r.byteLength !== n.byteLength) {
							var o = new Uint8Array(r.byteLength);
							o.set(new Uint8Array(n, r.byteOffset, r.byteLength)), n = o.buffer
						}
						e[t] = n
					}
				}
			}

			function BlobBuilderConstructor(e, t) {
				t = t || {};
				var n = new r;
				mapArrayBufferViews(e);
				for (var o = 0; o < e.length; o++) n.append(e[o]);
				return t.type ? n.getBlob(t.type) : n.getBlob()
			}

			function BlobConstructor(e, t) {
				return mapArrayBufferViews(e), new Blob(e, t || {})
			}
			var r = t.BlobBuilder || t.WebKitBlobBuilder || t.MSBlobBuilder || t.MozBlobBuilder,
				n = function () {
					try {
						return 2 === new Blob(["hi"]).size
					} catch (e) {
						return !1
					}
				}(),
				o = n && function () {
					try {
						return 2 === new Blob([new Uint8Array([1, 2])]).size
					} catch (e) {
						return !1
					}
				}(),
				i = r && r.prototype.append && r.prototype.getBlob;
			e.exports = function () {
				return n ? o ? t.Blob : BlobConstructor : i ? BlobBuilderConstructor : void 0
			}()
		}).call(t, r(0))
	}, function (e, t, r) {
		(function (t) {
			function empty() {}

			function JSONPPolling(e) {
				n.call(this, e), this.query = this.query || {}, i || (t.___eio || (t.___eio = []), i = t.___eio), this.index = i.length;
				var r = this;
				i.push(function (e) {
					r.onData(e)
				}), this.query.j = this.index, t.document && t.addEventListener && t.addEventListener("beforeunload", function () {
					r.script && (r.script.onerror = empty)
				}, !1)
			}
			var n = r(15),
				o = r(5);
			e.exports = JSONPPolling;
			var i, s = /\n/g,
				a = /\\n/g;
			o(JSONPPolling, n), JSONPPolling.prototype.supportsBinary = !1, JSONPPolling.prototype.doClose = function () {
				this.script && (this.script.parentNode.removeChild(this.script), this.script = null), this.form && (this.form.parentNode.removeChild(this.form), this.form = null, this.iframe = null), n.prototype.doClose.call(this)
			}, JSONPPolling.prototype.doPoll = function () {
				var e = this,
					t = document.createElement("script");
				this.script && (this.script.parentNode.removeChild(this.script), this.script = null), t.async = !0, t.src = this.uri(), t.onerror = function (t) {
					e.onError("jsonp poll error", t)
				};
				var r = document.getElementsByTagName("script")[0];
				r ? r.parentNode.insertBefore(t, r) : (document.head || document.body).appendChild(t), this.script = t, "undefined" != typeof navigator && /gecko/i.test(navigator.userAgent) && setTimeout(function () {
					var e = document.createElement("iframe");
					document.body.appendChild(e), document.body.removeChild(e)
				}, 100)
			}, JSONPPolling.prototype.doWrite = function (e, t) {
				function complete() {
					initIframe(), t()
				}

				function initIframe() {
					if (r.iframe) try {
						r.form.removeChild(r.iframe)
					} catch (e) {
						r.onError("jsonp polling iframe removal error", e)
					}
					try {
						var e = '<iframe src="javascript:0" name="' + r.iframeId + '">';
						n = document.createElement(e)
					} catch (e) {
						n = document.createElement("iframe"), n.name = r.iframeId, n.src = "javascript:0"
					}
					n.id = r.iframeId, r.form.appendChild(n), r.iframe = n
				}
				var r = this;
				if (!this.form) {
					var n, o = document.createElement("form"),
						i = document.createElement("textarea"),
						c = this.iframeId = "eio_iframe_" + this.index;
					o.className = "socketio", o.style.position = "absolute", o.style.top = "-1000px", o.style.left = "-1000px", o.target = c, o.method = "POST", o.setAttribute("accept-charset", "utf-8"), i.name = "d", o.appendChild(i), document.body.appendChild(o), this.form = o, this.area = i
				}
				this.form.action = this.uri(), initIframe(), e = e.replace(a, "\\\n"), this.area.value = e.replace(s, "\\n");
				try {
					this.form.submit()
				} catch (e) {}
				this.iframe.attachEvent ? this.iframe.onreadystatechange = function () {
					"complete" === r.iframe.readyState && complete()
				} : this.iframe.onload = complete
			}
		}).call(t, r(0))
	}, function (e, t, r) {
		(function (t) {
			function WS(e) {
				e && e.forceBase64 && (this.supportsBinary = !1), this.perMessageDeflate = e.perMessageDeflate, this.usingBrowserWebSocket = f && !e.forceNode, this.protocols = e.protocols, this.usingBrowserWebSocket || (h = n), o.call(this, e)
			}
			var n, o = r(8),
				i = r(3),
				s = r(4),
				a = r(5),
				c = r(16),
				u = r(1)("engine.io-client:websocket"),
				f = t.WebSocket || t.MozWebSocket;
			if ("undefined" == typeof window) try {
				n = r(44)
			} catch (e) {}
			var h = f;
			h || "undefined" != typeof window || (h = n), e.exports = WS, a(WS, o), WS.prototype.name = "websocket", WS.prototype.supportsBinary = !0, WS.prototype.doOpen = function () {
				if (this.check()) {
					var e = this.uri(),
						t = this.protocols,
						r = {
							agent: this.agent,
							perMessageDeflate: this.perMessageDeflate
						};
					r.pfx = this.pfx, r.key = this.key, r.passphrase = this.passphrase, r.cert = this.cert, r.ca = this.ca, r.ciphers = this.ciphers, r.rejectUnauthorized = this.rejectUnauthorized, this.extraHeaders && (r.headers = this.extraHeaders), this.localAddress && (r.localAddress = this.localAddress);
					try {
						this.ws = this.usingBrowserWebSocket ? t ? new h(e, t) : new h(e) : new h(e, t, r)
					} catch (e) {
						return this.emit("error", e)
					}
					void 0 === this.ws.binaryType && (this.supportsBinary = !1), this.ws.supports && this.ws.supports.binary ? (this.supportsBinary = !0, this.ws.binaryType = "nodebuffer") : this.ws.binaryType = "arraybuffer", this.addEventListeners()
				}
			}, WS.prototype.addEventListeners = function () {
				var e = this;
				this.ws.onopen = function () {
					e.onOpen()
				}, this.ws.onclose = function () {
					e.onClose()
				}, this.ws.onmessage = function (t) {
					e.onData(t.data)
				}, this.ws.onerror = function (t) {
					e.onError("websocket error", t)
				}
			}, WS.prototype.write = function (e) {
				function done() {
					r.emit("flush"), setTimeout(function () {
						r.writable = !0, r.emit("drain")
					}, 0)
				}
				var r = this;
				this.writable = !1;
				for (var n = e.length, o = 0, s = n; o < s; o++) ! function (e) {
					i.encodePacket(e, r.supportsBinary, function (o) {
						if (!r.usingBrowserWebSocket) {
							var i = {};
							if (e.options && (i.compress = e.options.compress), r.perMessageDeflate) {
								("string" == typeof o ? t.Buffer.byteLength(o) : o.length) < r.perMessageDeflate.threshold && (i.compress = !1)
							}
						}
						try {
							r.usingBrowserWebSocket ? r.ws.send(o) : r.ws.send(o, i)
						} catch (e) {
							u("websocket closed before onclose event")
						}--n || done()
					})
				}(e[o])
			}, WS.prototype.onClose = function () {
				o.prototype.onClose.call(this)
			}, WS.prototype.doClose = function () {
				void 0 !== this.ws && this.ws.close()
			}, WS.prototype.uri = function () {
				var e = this.query || {},
					t = this.secure ? "wss" : "ws",
					r = "";
				return this.port && ("wss" === t && 443 !== Number(this.port) || "ws" === t && 80 !== Number(this.port)) && (r = ":" + this.port), this.timestampRequests && (e[this.timestampParam] = c()), this.supportsBinary || (e.b64 = 1), e = s.encode(e), e.length && (e = "?" + e), t + "://" + (-1 !== this.hostname.indexOf(":") ? "[" + this.hostname + "]" : this.hostname) + r + this.path + e
			}, WS.prototype.check = function () {
				return !(!h || "__initialize" in h && this.name === WS.prototype.name)
			}
		}).call(t, r(0))
	}, function (e, t) {}, function (e, t, r) {
		(function (t) {
			var r = /^[\],:{}\s]*$/,
				n = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
				o = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
				i = /(?:^|:|,)(?:\s*\[)+/g,
				s = /^\s+/,
				a = /\s+$/;
			e.exports = function (e) {
				return "string" == typeof e && e ? (e = e.replace(s, "").replace(a, ""), t.JSON && JSON.parse ? JSON.parse(e) : r.test(e.replace(n, "@").replace(o, "]").replace(i, "")) ? new Function("return " + e)() : void 0) : null
			}
		}).call(t, r(0))
	}, function (e, t) {
		function toArray(e, t) {
			var r = [];
			t = t || 0;
			for (var n = t || 0; n < e.length; n++) r[n - t] = e[n];
			return r
		}
		e.exports = toArray
	}, function (e, t) {
		function Backoff(e) {
			e = e || {}, this.ms = e.min || 100, this.max = e.max || 1e4, this.factor = e.factor || 2, this.jitter = e.jitter > 0 && e.jitter <= 1 ? e.jitter : 0, this.attempts = 0
		}
		e.exports = Backoff, Backoff.prototype.duration = function () {
			var e = this.ms * Math.pow(this.factor, this.attempts++);
			if (this.jitter) {
				var t = Math.random(),
					r = Math.floor(t * this.jitter * e);
				e = 0 == (1 & Math.floor(10 * t)) ? e - r : e + r
			}
			return 0 | Math.min(e, this.max)
		}, Backoff.prototype.reset = function () {
			this.attempts = 0
		}, Backoff.prototype.setMin = function (e) {
			this.ms = e
		}, Backoff.prototype.setMax = function (e) {
			this.max = e
		}, Backoff.prototype.setJitter = function (e) {
			this.jitter = e
		}
	}, function (e, t, r) {
		"use strict";

		function _classCallCheck(e, t) {
			if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
		}

		function _possibleConstructorReturn(e, t) {
			if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
			return !t || "object" != typeof t && "function" != typeof t ? e : t
		}

		function _inherits(e, t) {
			if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
			e.prototype = Object.create(t && t.prototype, {
				constructor: {
					value: e,
					enumerable: !1,
					writable: !0,
					configurable: !0
				}
			}), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
		}
		Object.defineProperty(t, "__esModule", {
			value: !0
		});
		var n = function () {
				function defineProperties(e, t) {
					for (var r = 0; r < t.length; r++) {
						var n = t[r];
						n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
					}
				}
				return function (e, t, r) {
					return t && defineProperties(e.prototype, t), r && defineProperties(e, r), e
				}
			}(),
			o = r(21),
			i = function (e) {
				return e && e.__esModule ? e : {
					default: e
				}
			}(o),
			s = function (e) {
				function Adapter() {
					_classCallCheck(this, Adapter);
					var e = _possibleConstructorReturn(this, (Adapter.__proto__ || Object.getPrototypeOf(Adapter)).call(this));
					return e.isOpen = !1, e.device = null, e
				}
				return _inherits(Adapter, e), n(Adapter, [{
					key: "open",
					value: function () {
						var e = this;
						return new Promise(function (t) {
							return e.isOpen ? t() : (console.error("Not Implemented"), e.isOpen = !0, e.emit("open"), t())
						})
					}
				}, {
					key: "close",
					value: function () {
						var e = this;
						return new Promise(function (t) {
							return e.isOpen ? (console.error("Not Implemented"), e.isOpen = !1, e.emit("close"), t()) : t()
						})
					}
				}, {
					key: "write",
					value: function () {
						console.error("Not Implemented")
					}
				}]), Adapter
			}(i.default);
		t.default = s
	}, function (e, t, r) {
		"use strict";

		function _interopRequireDefault(e) {
			return e && e.__esModule ? e : {
				default: e
			}
		}

		function _classCallCheck(e, t) {
			if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
		}

		function _possibleConstructorReturn(e, t) {
			if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
			return !t || "object" != typeof t && "function" != typeof t ? e : t
		}

		function _inherits(e, t) {
			if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
			e.prototype = Object.create(t && t.prototype, {
				constructor: {
					value: e,
					enumerable: !1,
					writable: !0,
					configurable: !0
				}
			}), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
		}
		Object.defineProperty(t, "__esModule", {
			value: !0
		});
		var n = function () {
				function defineProperties(e, t) {
					for (var r = 0; r < t.length; r++) {
						var n = t[r];
						n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
					}
				}
				return function (e, t, r) {
					return t && defineProperties(e.prototype, t), r && defineProperties(e, r), e
				}
			}(),
			o = r(21),
			i = _interopRequireDefault(o),
			s = r(50),
			a = _interopRequireDefault(s),
			c = ["LEFT", "CENTER", "RIGHT"],
			u = ["UPC-A", "UPC-E", "EAN13", "EAN8", "CODE39", "ITF", "CODABAR", "CODE93", "CODE128"],
			f = function (e) {
				function Printer(e) {
					_classCallCheck(this, Printer);
					var t = _possibleConstructorReturn(this, (Printer.__proto__ || Object.getPrototypeOf(Printer)).call(this));
					return t.buffer = new a.default, t.adapter = e, t.adapter.on("open", function () {
						t.emit("open")
					}), t.adapter.on("close", function () {
						t.emit("close")
					}), t.adapter.on("error", function (e) {
						t.emit("error", e)
					}), t
				}
				return _inherits(Printer, e), n(Printer, [{
					key: "raw",
					value: function (e) {
						return this.buffer.write(e), this
					}
				}, {
					key: "feed",
					value: function () {
						var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 4;
						return this.buffer.write(Array(e).fill("\n").join("")), this
					}
				}, {
					key: "mode",
					value: function () {
						var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "A",
							t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
							r = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
							n = arguments.length > 3 && void 0 !== arguments[3] && arguments[3],
							o = arguments.length > 4 && void 0 !== arguments[4] && arguments[4],
							i = 0;
						return i |= "B" === e.toUpperCase() ? 1 : 0, i |= t ? 8 : 0, i |= r ? 16 : 0, i |= n ? 32 : 0, i |= o ? 128 : 0, this.buffer.write([27, 33]), this.buffer.writeUInt8(i), this
					}
				}, {
					key: "underline",
					value: function () {
						var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
						return this.buffer.write([27, 45]), this.buffer.writeUInt8(e), this
					}
				}, {
					key: "bold",
					value: function () {
						var e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0];
						return this.buffer.write([27, 69]), this.buffer.writeUInt8(e), this
					}
				}, {
					key: "text",
					value: function () {
						var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
						return this.buffer.write(e), this.buffer.write("\n"), this
					}
				}, {
					key: "align",
					value: function (e) {
						var t = c.indexOf(e.toUpperCase());
						if (t < 0) throw new Error("Not support align '" + e + "', only support 'LEFT', 'CENTER', 'RIGHT'");
						return this.buffer.write([27, 97]), this.buffer.writeUInt8(t), this
					}
				}, {
					key: "flush",
					value: function () {
						return this.buffer.flush()
					}
				}, {
					key: "reset",
					value: function () {
						return this.buffer.write([27, 64]), this.print(), this
					}
				}, {
					key: "font",
					value: function (e) {
						return this.buffer.write([27, 77]), this.buffer.writeUInt8("B" === e), this
					}
				}, {
					key: "cut",
					value: function () {
						var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0],
							t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 4;
						return this.buffer.write([29, 86]), this.buffer.writeUInt8(e), this.feed(t), this
					}
				}, {
					key: "barcode",
					value: function (e, t, r) {
						var n = u.indexOf(e.toUpperCase());
						if (n < 0) throw new Error("Not support barcode '" + e + "'");
						return r && this.barcodeHeight(r), this.buffer.write([29, 107]), this.buffer.writeUInt8(65 + n), this.buffer.writeUInt8(t.length), this.buffer.write(t), this
					}
				}, {
					key: "barcodeHeight",
					value: function (e) {
						return this.buffer.write([29, 104]), this.buffer.writeUInt8(e), this
					}
				}, {
					key: "print",
					value: function () {
						return this.adapter.write(this.flush())
					}
				}, {
					key: "clearBuffer",
					value: function () {
						return this.buffer.clear(), this
					}
				}, {
					key: "open",
					value: function () {
						return this.adapter.open()
					}
				}, {
					key: "close",
					value: function () {
						return this.adapter.close()
					}
				}, {
					key: "isOpen",
					get: function () {
						return this.adapter.isOpen
					}
				}]), Printer
			}(i.default);
		t.default = f
	}, function (e, t, r) {
		"use strict";
		var n = r(51);
		e.exports = t = n, t.MutableBuffer = n
	}, function (e, t, r) {
		"use strict";
		(function (t) {
			function MutableBuffer(e, o) {
				if (!(this instanceof MutableBuffer)) return new MutableBuffer(e, o);
				this._initialSize = e || r, this._blockSize = o || n, this._buffer = new t(this._initialSize), this._size = 0
			}
			var r = 1024,
				n = 1024;
			e.exports = MutableBuffer, Object.defineProperty(MutableBuffer.prototype, "size", {
				get: function () {
					return this._size
				}
			}), Object.defineProperty(MutableBuffer.prototype, "buffer", {
				get: function () {
					return this._buffer
				}
			}), Object.defineProperty(MutableBuffer.prototype, "nativeBuffer", {
				get: function () {
					return this._buffer
				}
			}), MutableBuffer.prototype._ensure = function (e) {
				var r = this._buffer.length - this._size;
				if (r < e) {
					var n = Math.ceil((e - r) / this._blockSize),
						o = this._buffer;
					this._buffer = new t(o.length + this._blockSize * n), o.copy(this._buffer)
				}
			}, MutableBuffer.prototype.capacity = function () {
				return this._buffer.length
			}, MutableBuffer.prototype.clear = function () {
				this._size = 0
			}, MutableBuffer.prototype.join = function () {
				return this._buffer.slice(0, this._size)
			}, MutableBuffer.prototype.flush = function () {
				var e = this.join();
				return this.clear(), e
			}, MutableBuffer.prototype.write = function (e, r) {
				if (t.isBuffer(e)) this._ensure(e.length), e.copy(this._buffer, this._size), this._size += e.length;
				else if (Array.isArray(e)) {
					this._ensure(e.length);
					for (var n = 0; n < e.length; n++) this._buffer[this._size + n] = e[n];
					this._size += e.length
				} else if (e && e.buffer && e.size) this._ensure(e.size), e.buffer.copy(this._buffer, this._size), this._size += e.size;
				else {
					e += "";
					var o = t.byteLength(e, r);
					this._ensure(o), this._buffer.write(e, this._size, r), this._size += o
				}
				return this
			}, MutableBuffer.prototype.writeCString = function (e, r) {
				if (e)
					if (t.isBuffer(e)) this._ensure(e.length), e.copy(this._buffer, this._size), this._size += e.length;
					else {
						var n = t.byteLength(e, r);
						this._ensure(n + 1), this._buffer.write(e, this._size, n, r), this._size += n
					}
				else this._ensure(1);
				return this._buffer[this._size++] = 0, this
			}, MutableBuffer.prototype.writeChar = function (e) {
				return this._ensure(1), this._buffer.write(e, this._size, 1), this._size++, this
			}, MutableBuffer.prototype.writeUIntLE = function (e, t, r) {
				return this._ensure(t >>> 0), this._size = this._buffer.writeUIntLE(e, this._size, t, r), this
			}, MutableBuffer.prototype.writeUIntBE = function (e, t, r) {
				return this._ensure(t >>> 0), this._size = this._buffer.writeUIntBE(e, this._size, t, r), this
			}, MutableBuffer.prototype.writeUInt8 = function (e, t) {
				return this._ensure(1), this._size = this._buffer.writeUInt8(e, this._size, t), this
			}, MutableBuffer.prototype.writeUInt16LE = function (e, t) {
				return this._ensure(2), this._size = this._buffer.writeUInt16LE(e, this._size, t), this
			}, MutableBuffer.prototype.writeUInt16BE = function (e, t) {
				return this._ensure(2), this._size = this._buffer.writeUInt16BE(e, this._size, t), this
			}, MutableBuffer.prototype.writeUInt32LE = function (e, t) {
				return this._ensure(4), this._size = this._buffer.writeUInt32LE(e, this._size, t), this
			}, MutableBuffer.prototype.writeUInt32BE = function (e, t) {
				return this._ensure(4), this._size = this._buffer.writeUInt32BE(e, this._size, t), this
			}, MutableBuffer.prototype.writeIntLE = function (e, t, r) {
				return this._ensure(t >>> 0), this._size = this._buffer.writeIntLE(e, this._size, t, r), this
			}, MutableBuffer.prototype.writeIntBE = function (e, t, r) {
				return this._ensure(t >>> 0), this._size = this._buffer.writeIntBE(e, this._size, t, r), this
			}, MutableBuffer.prototype.writeInt8 = function (e, t) {
				return this._ensure(1), this._size = this._buffer.writeInt8(e, this._size, t), this
			}, MutableBuffer.prototype.writeInt16LE = function (e, t) {
				return this._ensure(2), this._size = this._buffer.writeInt16LE(e, this._size, t), this
			}, MutableBuffer.prototype.writeInt16BE = function (e, t) {
				return this._ensure(2), this._size = this._buffer.writeInt16BE(e, this._size, t), this
			}, MutableBuffer.prototype.writeInt32LE = function (e, t) {
				return this._ensure(4), this._size = this._buffer.writeInt32LE(e, this._size, t), this
			}, MutableBuffer.prototype.writeInt32BE = function (e, t) {
				return this._ensure(4), this._size = this._buffer.writeInt32BE(e, this._size, t), this
			}, MutableBuffer.prototype.writeFloatLE = function (e, t) {
				return this._ensure(4), this._size = this._buffer.writeFloatLE(e, this._size, t), this
			}, MutableBuffer.prototype.writeFloatBE = function (e, t) {
				return this._ensure(4), this._size = this._buffer.writeFloatBE(e, this._size, t), this
			}, MutableBuffer.prototype.writeDoubleLE = function (e, t) {
				return this._ensure(8), this._size = this._buffer.writeDoubleLE(e, this._size, t), this
			}, MutableBuffer.prototype.writeDoubleBE = function (e, t) {
				return this._ensure(8), this._size = this._buffer.writeDoubleBE(e, this._size, t), this
			}
		}).call(t, r(52).Buffer)
	}, function (e, t, r) {
		"use strict";
		(function (e) {
			function kMaxLength() {
				return Buffer.TYPED_ARRAY_SUPPORT ? 2147483647 : 1073741823
			}

			function createBuffer(e, t) {
				if (kMaxLength() < t) throw new RangeError("Invalid typed array length");
				return Buffer.TYPED_ARRAY_SUPPORT ? (e = new Uint8Array(t), e.__proto__ = Buffer.prototype) : (null === e && (e = new Buffer(t)), e.length = t), e
			}

			function Buffer(e, t, r) {
				if (!(Buffer.TYPED_ARRAY_SUPPORT || this instanceof Buffer)) return new Buffer(e, t, r);
				if ("number" == typeof e) {
					if ("string" == typeof t) throw new Error("If encoding is specified then the first argument must be a string");
					return allocUnsafe(this, e)
				}
				return from(this, e, t, r)
			}

			function from(e, t, r, n) {
				if ("number" == typeof t) throw new TypeError('"value" argument must not be a number');
				return "undefined" != typeof ArrayBuffer && t instanceof ArrayBuffer ? fromArrayBuffer(e, t, r, n) : "string" == typeof t ? fromString(e, t, r) : fromObject(e, t)
			}

			function assertSize(e) {
				if ("number" != typeof e) throw new TypeError('"size" argument must be a number');
				if (e < 0) throw new RangeError('"size" argument must not be negative')
			}

			function alloc(e, t, r, n) {
				return assertSize(t), t <= 0 ? createBuffer(e, t) : void 0 !== r ? "string" == typeof n ? createBuffer(e, t).fill(r, n) : createBuffer(e, t).fill(r) : createBuffer(e, t)
			}

			function allocUnsafe(e, t) {
				if (assertSize(t), e = createBuffer(e, t < 0 ? 0 : 0 | checked(t)), !Buffer.TYPED_ARRAY_SUPPORT)
					for (var r = 0; r < t; ++r) e[r] = 0;
				return e
			}

			function fromString(e, t, r) {
				if ("string" == typeof r && "" !== r || (r = "utf8"), !Buffer.isEncoding(r)) throw new TypeError('"encoding" must be a valid string encoding');
				var n = 0 | byteLength(t, r);
				e = createBuffer(e, n);
				var o = e.write(t, r);
				return o !== n && (e = e.slice(0, o)), e
			}

			function fromArrayLike(e, t) {
				var r = t.length < 0 ? 0 : 0 | checked(t.length);
				e = createBuffer(e, r);
				for (var n = 0; n < r; n += 1) e[n] = 255 & t[n];
				return e
			}

			function fromArrayBuffer(e, t, r, n) {
				if (t.byteLength, r < 0 || t.byteLength < r) throw new RangeError("'offset' is out of bounds");
				if (t.byteLength < r + (n || 0)) throw new RangeError("'length' is out of bounds");
				return t = void 0 === r && void 0 === n ? new Uint8Array(t) : void 0 === n ? new Uint8Array(t, r) : new Uint8Array(t, r, n), Buffer.TYPED_ARRAY_SUPPORT ? (e = t, e.__proto__ = Buffer.prototype) : e = fromArrayLike(e, t), e
			}

			function fromObject(e, t) {
				if (Buffer.isBuffer(t)) {
					var r = 0 | checked(t.length);
					return e = createBuffer(e, r), 0 === e.length ? e : (t.copy(e, 0, 0, r), e)
				}
				if (t) {
					if ("undefined" != typeof ArrayBuffer && t.buffer instanceof ArrayBuffer || "length" in t) return "number" != typeof t.length || isnan(t.length) ? createBuffer(e, 0) : fromArrayLike(e, t);
					if ("Buffer" === t.type && i(t.data)) return fromArrayLike(e, t.data)
				}
				throw new TypeError("First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.")
			}

			function checked(e) {
				if (e >= kMaxLength()) throw new RangeError("Attempt to allocate Buffer larger than maximum size: 0x" + kMaxLength().toString(16) + " bytes");
				return 0 | e
			}

			function SlowBuffer(e) {
				return +e != e && (e = 0), Buffer.alloc(+e)
			}

			function byteLength(e, t) {
				if (Buffer.isBuffer(e)) return e.length;
				if ("undefined" != typeof ArrayBuffer && "function" == typeof ArrayBuffer.isView && (ArrayBuffer.isView(e) || e instanceof ArrayBuffer)) return e.byteLength;
				"string" != typeof e && (e = "" + e);
				var r = e.length;
				if (0 === r) return 0;
				for (var n = !1;;) switch (t) {
					case "ascii":
					case "latin1":
					case "binary":
						return r;
					case "utf8":
					case "utf-8":
					case void 0:
						return utf8ToBytes(e).length;
					case "ucs2":
					case "ucs-2":
					case "utf16le":
					case "utf-16le":
						return 2 * r;
					case "hex":
						return r >>> 1;
					case "base64":
						return base64ToBytes(e).length;
					default:
						if (n) return utf8ToBytes(e).length;
						t = ("" + t).toLowerCase(), n = !0
				}
			}

			function slowToString(e, t, r) {
				var n = !1;
				if ((void 0 === t || t < 0) && (t = 0), t > this.length) return "";
				if ((void 0 === r || r > this.length) && (r = this.length), r <= 0) return "";
				if (r >>>= 0, t >>>= 0, r <= t) return "";
				for (e || (e = "utf8");;) switch (e) {
					case "hex":
						return hexSlice(this, t, r);
					case "utf8":
					case "utf-8":
						return utf8Slice(this, t, r);
					case "ascii":
						return asciiSlice(this, t, r);
					case "latin1":
					case "binary":
						return latin1Slice(this, t, r);
					case "base64":
						return base64Slice(this, t, r);
					case "ucs2":
					case "ucs-2":
					case "utf16le":
					case "utf-16le":
						return utf16leSlice(this, t, r);
					default:
						if (n) throw new TypeError("Unknown encoding: " + e);
						e = (e + "").toLowerCase(), n = !0
				}
			}

			function swap(e, t, r) {
				var n = e[t];
				e[t] = e[r], e[r] = n
			}

			function bidirectionalIndexOf(e, t, r, n, o) {
				if (0 === e.length) return -1;
				if ("string" == typeof r ? (n = r, r = 0) : r > 2147483647 ? r = 2147483647 : r < -2147483648 && (r = -2147483648), r = +r, isNaN(r) && (r = o ? 0 : e.length - 1), r < 0 && (r = e.length + r), r >= e.length) {
					if (o) return -1;
					r = e.length - 1
				} else if (r < 0) {
					if (!o) return -1;
					r = 0
				}
				if ("string" == typeof t && (t = Buffer.from(t, n)), Buffer.isBuffer(t)) return 0 === t.length ? -1 : arrayIndexOf(e, t, r, n, o);
				if ("number" == typeof t) return t &= 255, Buffer.TYPED_ARRAY_SUPPORT && "function" == typeof Uint8Array.prototype.indexOf ? o ? Uint8Array.prototype.indexOf.call(e, t, r) : Uint8Array.prototype.lastIndexOf.call(e, t, r) : arrayIndexOf(e, [t], r, n, o);
				throw new TypeError("val must be string, number or Buffer")
			}

			function arrayIndexOf(e, t, r, n, o) {
				function read(e, t) {
					return 1 === i ? e[t] : e.readUInt16BE(t * i)
				}
				var i = 1,
					s = e.length,
					a = t.length;
				if (void 0 !== n && ("ucs2" === (n = String(n).toLowerCase()) || "ucs-2" === n || "utf16le" === n || "utf-16le" === n)) {
					if (e.length < 2 || t.length < 2) return -1;
					i = 2, s /= 2, a /= 2, r /= 2
				}
				var c;
				if (o) {
					var u = -1;
					for (c = r; c < s; c++)
						if (read(e, c) === read(t, -1 === u ? 0 : c - u)) {
							if (-1 === u && (u = c), c - u + 1 === a) return u * i
						} else -1 !== u && (c -= c - u), u = -1
				} else
					for (r + a > s && (r = s - a), c = r; c >= 0; c--) {
						for (var f = !0, h = 0; h < a; h++)
							if (read(e, c + h) !== read(t, h)) {
								f = !1;
								break
							} if (f) return c
					}
				return -1
			}

			function hexWrite(e, t, r, n) {
				r = Number(r) || 0;
				var o = e.length - r;
				n ? (n = Number(n)) > o && (n = o) : n = o;
				var i = t.length;
				if (i % 2 != 0) throw new TypeError("Invalid hex string");
				n > i / 2 && (n = i / 2);
				for (var s = 0; s < n; ++s) {
					var a = parseInt(t.substr(2 * s, 2), 16);
					if (isNaN(a)) return s;
					e[r + s] = a
				}
				return s
			}

			function utf8Write(e, t, r, n) {
				return blitBuffer(utf8ToBytes(t, e.length - r), e, r, n)
			}

			function asciiWrite(e, t, r, n) {
				return blitBuffer(asciiToBytes(t), e, r, n)
			}

			function latin1Write(e, t, r, n) {
				return asciiWrite(e, t, r, n)
			}

			function base64Write(e, t, r, n) {
				return blitBuffer(base64ToBytes(t), e, r, n)
			}

			function ucs2Write(e, t, r, n) {
				return blitBuffer(utf16leToBytes(t, e.length - r), e, r, n)
			}

			function base64Slice(e, t, r) {
				return 0 === t && r === e.length ? n.fromByteArray(e) : n.fromByteArray(e.slice(t, r))
			}

			function utf8Slice(e, t, r) {
				r = Math.min(e.length, r);
				for (var n = [], o = t; o < r;) {
					var i = e[o],
						s = null,
						a = i > 239 ? 4 : i > 223 ? 3 : i > 191 ? 2 : 1;
					if (o + a <= r) {
						var c, u, f, h;
						switch (a) {
							case 1:
								i < 128 && (s = i);
								break;
							case 2:
								c = e[o + 1], 128 == (192 & c) && (h = (31 & i) << 6 | 63 & c) > 127 && (s = h);
								break;
							case 3:
								c = e[o + 1], u = e[o + 2], 128 == (192 & c) && 128 == (192 & u) && (h = (15 & i) << 12 | (63 & c) << 6 | 63 & u) > 2047 && (h < 55296 || h > 57343) && (s = h);
								break;
							case 4:
								c = e[o + 1], u = e[o + 2], f = e[o + 3], 128 == (192 & c) && 128 == (192 & u) && 128 == (192 & f) && (h = (15 & i) << 18 | (63 & c) << 12 | (63 & u) << 6 | 63 & f) > 65535 && h < 1114112 && (s = h)
						}
					}
					null === s ? (s = 65533, a = 1) : s > 65535 && (s -= 65536, n.push(s >>> 10 & 1023 | 55296), s = 56320 | 1023 & s), n.push(s), o += a
				}
				return decodeCodePointsArray(n)
			}

			function decodeCodePointsArray(e) {
				var t = e.length;
				if (t <= s) return String.fromCharCode.apply(String, e);
				for (var r = "", n = 0; n < t;) r += String.fromCharCode.apply(String, e.slice(n, n += s));
				return r
			}

			function asciiSlice(e, t, r) {
				var n = "";
				r = Math.min(e.length, r);
				for (var o = t; o < r; ++o) n += String.fromCharCode(127 & e[o]);
				return n
			}

			function latin1Slice(e, t, r) {
				var n = "";
				r = Math.min(e.length, r);
				for (var o = t; o < r; ++o) n += String.fromCharCode(e[o]);
				return n
			}

			function hexSlice(e, t, r) {
				var n = e.length;
				(!t || t < 0) && (t = 0), (!r || r < 0 || r > n) && (r = n);
				for (var o = "", i = t; i < r; ++i) o += toHex(e[i]);
				return o
			}

			function utf16leSlice(e, t, r) {
				for (var n = e.slice(t, r), o = "", i = 0; i < n.length; i += 2) o += String.fromCharCode(n[i] + 256 * n[i + 1]);
				return o
			}

			function checkOffset(e, t, r) {
				if (e % 1 != 0 || e < 0) throw new RangeError("offset is not uint");
				if (e + t > r) throw new RangeError("Trying to access beyond buffer length")
			}

			function checkInt(e, t, r, n, o, i) {
				if (!Buffer.isBuffer(e)) throw new TypeError('"buffer" argument must be a Buffer instance');
				if (t > o || t < i) throw new RangeError('"value" argument is out of bounds');
				if (r + n > e.length) throw new RangeError("Index out of range")
			}

			function objectWriteUInt16(e, t, r, n) {
				t < 0 && (t = 65535 + t + 1);
				for (var o = 0, i = Math.min(e.length - r, 2); o < i; ++o) e[r + o] = (t & 255 << 8 * (n ? o : 1 - o)) >>> 8 * (n ? o : 1 - o)
			}

			function objectWriteUInt32(e, t, r, n) {
				t < 0 && (t = 4294967295 + t + 1);
				for (var o = 0, i = Math.min(e.length - r, 4); o < i; ++o) e[r + o] = t >>> 8 * (n ? o : 3 - o) & 255
			}

			function checkIEEE754(e, t, r, n, o, i) {
				if (r + n > e.length) throw new RangeError("Index out of range");
				if (r < 0) throw new RangeError("Index out of range")
			}

			function writeFloat(e, t, r, n, i) {
				return i || checkIEEE754(e, t, r, 4, 3.4028234663852886e38, -3.4028234663852886e38), o.write(e, t, r, n, 23, 4), r + 4
			}

			function writeDouble(e, t, r, n, i) {
				return i || checkIEEE754(e, t, r, 8, 1.7976931348623157e308, -1.7976931348623157e308), o.write(e, t, r, n, 52, 8), r + 8
			}

			function base64clean(e) {
				if (e = stringtrim(e).replace(a, ""), e.length < 2) return "";
				for (; e.length % 4 != 0;) e += "=";
				return e
			}

			function stringtrim(e) {
				return e.trim ? e.trim() : e.replace(/^\s+|\s+$/g, "")
			}

			function toHex(e) {
				return e < 16 ? "0" + e.toString(16) : e.toString(16)
			}

			function utf8ToBytes(e, t) {
				t = t || 1 / 0;
				for (var r, n = e.length, o = null, i = [], s = 0; s < n; ++s) {
					if ((r = e.charCodeAt(s)) > 55295 && r < 57344) {
						if (!o) {
							if (r > 56319) {
								(t -= 3) > -1 && i.push(239, 191, 189);
								continue
							}
							if (s + 1 === n) {
								(t -= 3) > -1 && i.push(239, 191, 189);
								continue
							}
							o = r;
							continue
						}
						if (r < 56320) {
							(t -= 3) > -1 && i.push(239, 191, 189), o = r;
							continue
						}
						r = 65536 + (o - 55296 << 10 | r - 56320)
					} else o && (t -= 3) > -1 && i.push(239, 191, 189);
					if (o = null, r < 128) {
						if ((t -= 1) < 0) break;
						i.push(r)
					} else if (r < 2048) {
						if ((t -= 2) < 0) break;
						i.push(r >> 6 | 192, 63 & r | 128)
					} else if (r < 65536) {
						if ((t -= 3) < 0) break;
						i.push(r >> 12 | 224, r >> 6 & 63 | 128, 63 & r | 128)
					} else {
						if (!(r < 1114112)) throw new Error("Invalid code point");
						if ((t -= 4) < 0) break;
						i.push(r >> 18 | 240, r >> 12 & 63 | 128, r >> 6 & 63 | 128, 63 & r | 128)
					}
				}
				return i
			}

			function asciiToBytes(e) {
				for (var t = [], r = 0; r < e.length; ++r) t.push(255 & e.charCodeAt(r));
				return t
			}

			function utf16leToBytes(e, t) {
				for (var r, n, o, i = [], s = 0; s < e.length && !((t -= 2) < 0); ++s) r = e.charCodeAt(s), n = r >> 8, o = r % 256, i.push(o), i.push(n);
				return i
			}

			function base64ToBytes(e) {
				return n.toByteArray(base64clean(e))
			}

			function blitBuffer(e, t, r, n) {
				for (var o = 0; o < n && !(o + r >= t.length || o >= e.length); ++o) t[o + r] = e[o];
				return o
			}

			function isnan(e) {
				return e !== e
			}
			var n = r(53),
				o = r(54),
				i = r(55);
			t.Buffer = Buffer, t.SlowBuffer = SlowBuffer, t.INSPECT_MAX_BYTES = 50, Buffer.TYPED_ARRAY_SUPPORT = void 0 !== e.TYPED_ARRAY_SUPPORT ? e.TYPED_ARRAY_SUPPORT : function () {
				try {
					var e = new Uint8Array(1);
					return e.__proto__ = {
						__proto__: Uint8Array.prototype,
						foo: function () {
							return 42
						}
					}, 42 === e.foo() && "function" == typeof e.subarray && 0 === e.subarray(1, 1).byteLength
				} catch (e) {
					return !1
				}
			}(), t.kMaxLength = kMaxLength(), Buffer.poolSize = 8192, Buffer._augment = function (e) {
				return e.__proto__ = Buffer.prototype, e
			}, Buffer.from = function (e, t, r) {
				return from(null, e, t, r)
			}, Buffer.TYPED_ARRAY_SUPPORT && (Buffer.prototype.__proto__ = Uint8Array.prototype, Buffer.__proto__ = Uint8Array, "undefined" != typeof Symbol && Symbol.species && Buffer[Symbol.species] === Buffer && Object.defineProperty(Buffer, Symbol.species, {
				value: null,
				configurable: !0
			})), Buffer.alloc = function (e, t, r) {
				return alloc(null, e, t, r)
			}, Buffer.allocUnsafe = function (e) {
				return allocUnsafe(null, e)
			}, Buffer.allocUnsafeSlow = function (e) {
				return allocUnsafe(null, e)
			}, Buffer.isBuffer = function (e) {
				return !(null == e || !e._isBuffer)
			}, Buffer.compare = function (e, t) {
				if (!Buffer.isBuffer(e) || !Buffer.isBuffer(t)) throw new TypeError("Arguments must be Buffers");
				if (e === t) return 0;
				for (var r = e.length, n = t.length, o = 0, i = Math.min(r, n); o < i; ++o)
					if (e[o] !== t[o]) {
						r = e[o], n = t[o];
						break
					} return r < n ? -1 : n < r ? 1 : 0
			}, Buffer.isEncoding = function (e) {
				switch (String(e).toLowerCase()) {
					case "hex":
					case "utf8":
					case "utf-8":
					case "ascii":
					case "latin1":
					case "binary":
					case "base64":
					case "ucs2":
					case "ucs-2":
					case "utf16le":
					case "utf-16le":
						return !0;
					default:
						return !1
				}
			}, Buffer.concat = function (e, t) {
				if (!i(e)) throw new TypeError('"list" argument must be an Array of Buffers');
				if (0 === e.length) return Buffer.alloc(0);
				var r;
				if (void 0 === t)
					for (t = 0, r = 0; r < e.length; ++r) t += e[r].length;
				var n = Buffer.allocUnsafe(t),
					o = 0;
				for (r = 0; r < e.length; ++r) {
					var s = e[r];
					if (!Buffer.isBuffer(s)) throw new TypeError('"list" argument must be an Array of Buffers');
					s.copy(n, o), o += s.length
				}
				return n
			}, Buffer.byteLength = byteLength, Buffer.prototype._isBuffer = !0, Buffer.prototype.swap16 = function () {
				var e = this.length;
				if (e % 2 != 0) throw new RangeError("Buffer size must be a multiple of 16-bits");
				for (var t = 0; t < e; t += 2) swap(this, t, t + 1);
				return this
			}, Buffer.prototype.swap32 = function () {
				var e = this.length;
				if (e % 4 != 0) throw new RangeError("Buffer size must be a multiple of 32-bits");
				for (var t = 0; t < e; t += 4) swap(this, t, t + 3), swap(this, t + 1, t + 2);
				return this
			}, Buffer.prototype.swap64 = function () {
				var e = this.length;
				if (e % 8 != 0) throw new RangeError("Buffer size must be a multiple of 64-bits");
				for (var t = 0; t < e; t += 8) swap(this, t, t + 7), swap(this, t + 1, t + 6), swap(this, t + 2, t + 5), swap(this, t + 3, t + 4);
				return this
			}, Buffer.prototype.toString = function () {
				var e = 0 | this.length;
				return 0 === e ? "" : 0 === arguments.length ? utf8Slice(this, 0, e) : slowToString.apply(this, arguments)
			}, Buffer.prototype.equals = function (e) {
				if (!Buffer.isBuffer(e)) throw new TypeError("Argument must be a Buffer");
				return this === e || 0 === Buffer.compare(this, e)
			}, Buffer.prototype.inspect = function () {
				var e = "",
					r = t.INSPECT_MAX_BYTES;
				return this.length > 0 && (e = this.toString("hex", 0, r).match(/.{2}/g).join(" "), this.length > r && (e += " ... ")), "<Buffer " + e + ">"
			}, Buffer.prototype.compare = function (e, t, r, n, o) {
				if (!Buffer.isBuffer(e)) throw new TypeError("Argument must be a Buffer");
				if (void 0 === t && (t = 0), void 0 === r && (r = e ? e.length : 0), void 0 === n && (n = 0), void 0 === o && (o = this.length), t < 0 || r > e.length || n < 0 || o > this.length) throw new RangeError("out of range index");
				if (n >= o && t >= r) return 0;
				if (n >= o) return -1;
				if (t >= r) return 1;
				if (t >>>= 0, r >>>= 0, n >>>= 0, o >>>= 0, this === e) return 0;
				for (var i = o - n, s = r - t, a = Math.min(i, s), c = this.slice(n, o), u = e.slice(t, r), f = 0; f < a; ++f)
					if (c[f] !== u[f]) {
						i = c[f], s = u[f];
						break
					} return i < s ? -1 : s < i ? 1 : 0
			}, Buffer.prototype.includes = function (e, t, r) {
				return -1 !== this.indexOf(e, t, r)
			}, Buffer.prototype.indexOf = function (e, t, r) {
				return bidirectionalIndexOf(this, e, t, r, !0)
			}, Buffer.prototype.lastIndexOf = function (e, t, r) {
				return bidirectionalIndexOf(this, e, t, r, !1)
			}, Buffer.prototype.write = function (e, t, r, n) {
				if (void 0 === t) n = "utf8", r = this.length, t = 0;
				else if (void 0 === r && "string" == typeof t) n = t, r = this.length, t = 0;
				else {
					if (!isFinite(t)) throw new Error("Buffer.write(string, encoding, offset[, length]) is no longer supported");
					t |= 0, isFinite(r) ? (r |= 0, void 0 === n && (n = "utf8")) : (n = r, r = void 0)
				}
				var o = this.length - t;
				if ((void 0 === r || r > o) && (r = o), e.length > 0 && (r < 0 || t < 0) || t > this.length) throw new RangeError("Attempt to write outside buffer bounds");
				n || (n = "utf8");
				for (var i = !1;;) switch (n) {
					case "hex":
						return hexWrite(this, e, t, r);
					case "utf8":
					case "utf-8":
						return utf8Write(this, e, t, r);
					case "ascii":
						return asciiWrite(this, e, t, r);
					case "latin1":
					case "binary":
						return latin1Write(this, e, t, r);
					case "base64":
						return base64Write(this, e, t, r);
					case "ucs2":
					case "ucs-2":
					case "utf16le":
					case "utf-16le":
						return ucs2Write(this, e, t, r);
					default:
						if (i) throw new TypeError("Unknown encoding: " + n);
						n = ("" + n).toLowerCase(), i = !0
				}
			}, Buffer.prototype.toJSON = function () {
				return {
					type: "Buffer",
					data: Array.prototype.slice.call(this._arr || this, 0)
				}
			};
			var s = 4096;
			Buffer.prototype.slice = function (e, t) {
				var r = this.length;
				e = ~~e, t = void 0 === t ? r : ~~t, e < 0 ? (e += r) < 0 && (e = 0) : e > r && (e = r), t < 0 ? (t += r) < 0 && (t = 0) : t > r && (t = r), t < e && (t = e);
				var n;
				if (Buffer.TYPED_ARRAY_SUPPORT) n = this.subarray(e, t), n.__proto__ = Buffer.prototype;
				else {
					var o = t - e;
					n = new Buffer(o, void 0);
					for (var i = 0; i < o; ++i) n[i] = this[i + e]
				}
				return n
			}, Buffer.prototype.readUIntLE = function (e, t, r) {
				e |= 0, t |= 0, r || checkOffset(e, t, this.length);
				for (var n = this[e], o = 1, i = 0; ++i < t && (o *= 256);) n += this[e + i] * o;
				return n
			}, Buffer.prototype.readUIntBE = function (e, t, r) {
				e |= 0, t |= 0, r || checkOffset(e, t, this.length);
				for (var n = this[e + --t], o = 1; t > 0 && (o *= 256);) n += this[e + --t] * o;
				return n
			}, Buffer.prototype.readUInt8 = function (e, t) {
				return t || checkOffset(e, 1, this.length), this[e]
			}, Buffer.prototype.readUInt16LE = function (e, t) {
				return t || checkOffset(e, 2, this.length), this[e] | this[e + 1] << 8
			}, Buffer.prototype.readUInt16BE = function (e, t) {
				return t || checkOffset(e, 2, this.length), this[e] << 8 | this[e + 1]
			}, Buffer.prototype.readUInt32LE = function (e, t) {
				return t || checkOffset(e, 4, this.length), (this[e] | this[e + 1] << 8 | this[e + 2] << 16) + 16777216 * this[e + 3]
			}, Buffer.prototype.readUInt32BE = function (e, t) {
				return t || checkOffset(e, 4, this.length), 16777216 * this[e] + (this[e + 1] << 16 | this[e + 2] << 8 | this[e + 3])
			}, Buffer.prototype.readIntLE = function (e, t, r) {
				e |= 0, t |= 0, r || checkOffset(e, t, this.length);
				for (var n = this[e], o = 1, i = 0; ++i < t && (o *= 256);) n += this[e + i] * o;
				return o *= 128, n >= o && (n -= Math.pow(2, 8 * t)), n
			}, Buffer.prototype.readIntBE = function (e, t, r) {
				e |= 0, t |= 0, r || checkOffset(e, t, this.length);
				for (var n = t, o = 1, i = this[e + --n]; n > 0 && (o *= 256);) i += this[e + --n] * o;
				return o *= 128, i >= o && (i -= Math.pow(2, 8 * t)), i
			}, Buffer.prototype.readInt8 = function (e, t) {
				return t || checkOffset(e, 1, this.length), 128 & this[e] ? -1 * (255 - this[e] + 1) : this[e]
			}, Buffer.prototype.readInt16LE = function (e, t) {
				t || checkOffset(e, 2, this.length);
				var r = this[e] | this[e + 1] << 8;
				return 32768 & r ? 4294901760 | r : r
			}, Buffer.prototype.readInt16BE = function (e, t) {
				t || checkOffset(e, 2, this.length);
				var r = this[e + 1] | this[e] << 8;
				return 32768 & r ? 4294901760 | r : r
			}, Buffer.prototype.readInt32LE = function (e, t) {
				return t || checkOffset(e, 4, this.length), this[e] | this[e + 1] << 8 | this[e + 2] << 16 | this[e + 3] << 24
			}, Buffer.prototype.readInt32BE = function (e, t) {
				return t || checkOffset(e, 4, this.length), this[e] << 24 | this[e + 1] << 16 | this[e + 2] << 8 | this[e + 3]
			}, Buffer.prototype.readFloatLE = function (e, t) {
				return t || checkOffset(e, 4, this.length), o.read(this, e, !0, 23, 4)
			}, Buffer.prototype.readFloatBE = function (e, t) {
				return t || checkOffset(e, 4, this.length), o.read(this, e, !1, 23, 4)
			}, Buffer.prototype.readDoubleLE = function (e, t) {
				return t || checkOffset(e, 8, this.length), o.read(this, e, !0, 52, 8)
			}, Buffer.prototype.readDoubleBE = function (e, t) {
				return t || checkOffset(e, 8, this.length), o.read(this, e, !1, 52, 8)
			}, Buffer.prototype.writeUIntLE = function (e, t, r, n) {
				if (e = +e, t |= 0, r |= 0, !n) {
					checkInt(this, e, t, r, Math.pow(2, 8 * r) - 1, 0)
				}
				var o = 1,
					i = 0;
				for (this[t] = 255 & e; ++i < r && (o *= 256);) this[t + i] = e / o & 255;
				return t + r
			}, Buffer.prototype.writeUIntBE = function (e, t, r, n) {
				if (e = +e, t |= 0, r |= 0, !n) {
					checkInt(this, e, t, r, Math.pow(2, 8 * r) - 1, 0)
				}
				var o = r - 1,
					i = 1;
				for (this[t + o] = 255 & e; --o >= 0 && (i *= 256);) this[t + o] = e / i & 255;
				return t + r
			}, Buffer.prototype.writeUInt8 = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 1, 255, 0), Buffer.TYPED_ARRAY_SUPPORT || (e = Math.floor(e)), this[t] = 255 & e, t + 1
			}, Buffer.prototype.writeUInt16LE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 2, 65535, 0), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = 255 & e, this[t + 1] = e >>> 8) : objectWriteUInt16(this, e, t, !0), t + 2
			}, Buffer.prototype.writeUInt16BE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 2, 65535, 0), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 8, this[t + 1] = 255 & e) : objectWriteUInt16(this, e, t, !1), t + 2
			}, Buffer.prototype.writeUInt32LE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 4, 4294967295, 0), Buffer.TYPED_ARRAY_SUPPORT ? (this[t + 3] = e >>> 24, this[t + 2] = e >>> 16, this[t + 1] = e >>> 8, this[t] = 255 & e) : objectWriteUInt32(this, e, t, !0), t + 4
			}, Buffer.prototype.writeUInt32BE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 4, 4294967295, 0), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 24, this[t + 1] = e >>> 16, this[t + 2] = e >>> 8, this[t + 3] = 255 & e) : objectWriteUInt32(this, e, t, !1), t + 4
			}, Buffer.prototype.writeIntLE = function (e, t, r, n) {
				if (e = +e, t |= 0, !n) {
					var o = Math.pow(2, 8 * r - 1);
					checkInt(this, e, t, r, o - 1, -o)
				}
				var i = 0,
					s = 1,
					a = 0;
				for (this[t] = 255 & e; ++i < r && (s *= 256);) e < 0 && 0 === a && 0 !== this[t + i - 1] && (a = 1), this[t + i] = (e / s >> 0) - a & 255;
				return t + r
			}, Buffer.prototype.writeIntBE = function (e, t, r, n) {
				if (e = +e, t |= 0, !n) {
					var o = Math.pow(2, 8 * r - 1);
					checkInt(this, e, t, r, o - 1, -o)
				}
				var i = r - 1,
					s = 1,
					a = 0;
				for (this[t + i] = 255 & e; --i >= 0 && (s *= 256);) e < 0 && 0 === a && 0 !== this[t + i + 1] && (a = 1), this[t + i] = (e / s >> 0) - a & 255;
				return t + r
			}, Buffer.prototype.writeInt8 = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 1, 127, -128), Buffer.TYPED_ARRAY_SUPPORT || (e = Math.floor(e)), e < 0 && (e = 255 + e + 1), this[t] = 255 & e, t + 1
			}, Buffer.prototype.writeInt16LE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 2, 32767, -32768), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = 255 & e, this[t + 1] = e >>> 8) : objectWriteUInt16(this, e, t, !0), t + 2
			}, Buffer.prototype.writeInt16BE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 2, 32767, -32768), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 8, this[t + 1] = 255 & e) : objectWriteUInt16(this, e, t, !1), t + 2
			}, Buffer.prototype.writeInt32LE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 4, 2147483647, -2147483648), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = 255 & e, this[t + 1] = e >>> 8, this[t + 2] = e >>> 16, this[t + 3] = e >>> 24) : objectWriteUInt32(this, e, t, !0), t + 4
			}, Buffer.prototype.writeInt32BE = function (e, t, r) {
				return e = +e, t |= 0, r || checkInt(this, e, t, 4, 2147483647, -2147483648), e < 0 && (e = 4294967295 + e + 1), Buffer.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 24, this[t + 1] = e >>> 16, this[t + 2] = e >>> 8, this[t + 3] = 255 & e) : objectWriteUInt32(this, e, t, !1), t + 4
			}, Buffer.prototype.writeFloatLE = function (e, t, r) {
				return writeFloat(this, e, t, !0, r)
			}, Buffer.prototype.writeFloatBE = function (e, t, r) {
				return writeFloat(this, e, t, !1, r)
			}, Buffer.prototype.writeDoubleLE = function (e, t, r) {
				return writeDouble(this, e, t, !0, r)
			}, Buffer.prototype.writeDoubleBE = function (e, t, r) {
				return writeDouble(this, e, t, !1, r)
			}, Buffer.prototype.copy = function (e, t, r, n) {
				if (r || (r = 0), n || 0 === n || (n = this.length), t >= e.length && (t = e.length), t || (t = 0), n > 0 && n < r && (n = r), n === r) return 0;
				if (0 === e.length || 0 === this.length) return 0;
				if (t < 0) throw new RangeError("targetStart out of bounds");
				if (r < 0 || r >= this.length) throw new RangeError("sourceStart out of bounds");
				if (n < 0) throw new RangeError("sourceEnd out of bounds");
				n > this.length && (n = this.length), e.length - t < n - r && (n = e.length - t + r);
				var o, i = n - r;
				if (this === e && r < t && t < n)
					for (o = i - 1; o >= 0; --o) e[o + t] = this[o + r];
				else if (i < 1e3 || !Buffer.TYPED_ARRAY_SUPPORT)
					for (o = 0; o < i; ++o) e[o + t] = this[o + r];
				else Uint8Array.prototype.set.call(e, this.subarray(r, r + i), t);
				return i
			}, Buffer.prototype.fill = function (e, t, r, n) {
				if ("string" == typeof e) {
					if ("string" == typeof t ? (n = t, t = 0, r = this.length) : "string" == typeof r && (n = r, r = this.length), 1 === e.length) {
						var o = e.charCodeAt(0);
						o < 256 && (e = o)
					}
					if (void 0 !== n && "string" != typeof n) throw new TypeError("encoding must be a string");
					if ("string" == typeof n && !Buffer.isEncoding(n)) throw new TypeError("Unknown encoding: " + n)
				} else "number" == typeof e && (e &= 255);
				if (t < 0 || this.length < t || this.length < r) throw new RangeError("Out of range index");
				if (r <= t) return this;
				t >>>= 0, r = void 0 === r ? this.length : r >>> 0, e || (e = 0);
				var i;
				if ("number" == typeof e)
					for (i = t; i < r; ++i) this[i] = e;
				else {
					var s = Buffer.isBuffer(e) ? e : utf8ToBytes(new Buffer(e, n).toString()),
						a = s.length;
					for (i = 0; i < r - t; ++i) this[i + t] = s[i % a]
				}
				return this
			};
			var a = /[^+\/0-9A-Za-z-_]/g
		}).call(t, r(0))
	}, function (e, t, r) {
		"use strict";

		function placeHoldersCount(e) {
			var t = e.length;
			if (t % 4 > 0) throw new Error("Invalid string. Length must be a multiple of 4");
			return "=" === e[t - 2] ? 2 : "=" === e[t - 1] ? 1 : 0
		}

		function byteLength(e) {
			return 3 * e.length / 4 - placeHoldersCount(e)
		}

		function toByteArray(e) {
			var t, r, n, s, a, c = e.length;
			s = placeHoldersCount(e), a = new i(3 * c / 4 - s), r = s > 0 ? c - 4 : c;
			var u = 0;
			for (t = 0; t < r; t += 4) n = o[e.charCodeAt(t)] << 18 | o[e.charCodeAt(t + 1)] << 12 | o[e.charCodeAt(t + 2)] << 6 | o[e.charCodeAt(t + 3)], a[u++] = n >> 16 & 255, a[u++] = n >> 8 & 255, a[u++] = 255 & n;
			return 2 === s ? (n = o[e.charCodeAt(t)] << 2 | o[e.charCodeAt(t + 1)] >> 4, a[u++] = 255 & n) : 1 === s && (n = o[e.charCodeAt(t)] << 10 | o[e.charCodeAt(t + 1)] << 4 | o[e.charCodeAt(t + 2)] >> 2, a[u++] = n >> 8 & 255, a[u++] = 255 & n), a
		}

		function tripletToBase64(e) {
			return n[e >> 18 & 63] + n[e >> 12 & 63] + n[e >> 6 & 63] + n[63 & e]
		}

		function encodeChunk(e, t, r) {
			for (var n, o = [], i = t; i < r; i += 3) n = (e[i] << 16) + (e[i + 1] << 8) + e[i + 2], o.push(tripletToBase64(n));
			return o.join("")
		}

		function fromByteArray(e) {
			for (var t, r = e.length, o = r % 3, i = "", s = [], a = 0, c = r - o; a < c; a += 16383) s.push(encodeChunk(e, a, a + 16383 > c ? c : a + 16383));
			return 1 === o ? (t = e[r - 1], i += n[t >> 2], i += n[t << 4 & 63], i += "==") : 2 === o && (t = (e[r - 2] << 8) + e[r - 1], i += n[t >> 10], i += n[t >> 4 & 63], i += n[t << 2 & 63], i += "="), s.push(i), s.join("")
		}
		t.byteLength = byteLength, t.toByteArray = toByteArray, t.fromByteArray = fromByteArray;
		for (var n = [], o = [], i = "undefined" != typeof Uint8Array ? Uint8Array : Array, s = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", a = 0, c = s.length; a < c; ++a) n[a] = s[a], o[s.charCodeAt(a)] = a;
		o["-".charCodeAt(0)] = 62, o["_".charCodeAt(0)] = 63
	}, function (e, t) {
		t.read = function (e, t, r, n, o) {
			var i, s, a = 8 * o - n - 1,
				c = (1 << a) - 1,
				u = c >> 1,
				f = -7,
				h = r ? o - 1 : 0,
				p = r ? -1 : 1,
				l = e[t + h];
			for (h += p, i = l & (1 << -f) - 1, l >>= -f, f += a; f > 0; i = 256 * i + e[t + h], h += p, f -= 8);
			for (s = i & (1 << -f) - 1, i >>= -f, f += n; f > 0; s = 256 * s + e[t + h], h += p, f -= 8);
			if (0 === i) i = 1 - u;
			else {
				if (i === c) return s ? NaN : 1 / 0 * (l ? -1 : 1);
				s += Math.pow(2, n), i -= u
			}
			return (l ? -1 : 1) * s * Math.pow(2, i - n)
		}, t.write = function (e, t, r, n, o, i) {
			var s, a, c, u = 8 * i - o - 1,
				f = (1 << u) - 1,
				h = f >> 1,
				p = 23 === o ? Math.pow(2, -24) - Math.pow(2, -77) : 0,
				l = n ? 0 : i - 1,
				d = n ? 1 : -1,
				y = t < 0 || 0 === t && 1 / t < 0 ? 1 : 0;
			for (t = Math.abs(t), isNaN(t) || t === 1 / 0 ? (a = isNaN(t) ? 1 : 0, s = f) : (s = Math.floor(Math.log(t) / Math.LN2), t * (c = Math.pow(2, -s)) < 1 && (s--, c *= 2), t += s + h >= 1 ? p / c : p * Math.pow(2, 1 - h), t * c >= 2 && (s++, c /= 2), s + h >= f ? (a = 0, s = f) : s + h >= 1 ? (a = (t * c - 1) * Math.pow(2, o), s += h) : (a = t * Math.pow(2, h - 1) * Math.pow(2, o), s = 0)); o >= 8; e[r + l] = 255 & a, l += d, a /= 256, o -= 8);
			for (s = s << o | a, u += o; u > 0; e[r + l] = 255 & s, l += d, s /= 256, u -= 8);
			e[r + l - d] |= 128 * y
		}
	}, function (e, t) {
		var r = {}.toString;
		e.exports = Array.isArray || function (e) {
			return "[object Array]" == r.call(e)
		}
	}]).default
});
