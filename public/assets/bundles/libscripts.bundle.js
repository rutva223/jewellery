! function(e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function(x, e) {
    "use strict";
    var t = [],
        i = Object.getPrototypeOf,
        a = t.slice,
        m = t.flat ? function(e) {
            return t.flat.call(e)
        } : function(e) {
            return t.concat.apply([], e)
        },
        l = t.push,
        r = t.indexOf,
        n = {},
        o = n.toString,
        g = n.hasOwnProperty,
        s = g.toString,
        u = s.call(Object),
        v = {},
        y = function(e) {
            return "function" == typeof e && "number" != typeof e.nodeType
        },
        b = function(e) {
            return null != e && e === e.window
        },
        T = x.document,
        c = {
            type: !0,
            src: !0,
            nonce: !0,
            noModule: !0
        };

    function _(e, t, n) {
        var i, r, o = (n = n || T).createElement("script");
        if (o.text = e, t)
            for (i in c)(r = t[i] || t.getAttribute && t.getAttribute(i)) && o.setAttribute(i, r);
        n.head.appendChild(o).parentNode.removeChild(o)
    }

    function w(e) {
        return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? n[o.call(e)] || "object" : typeof e
    }
    var f = "3.5.1",
        C = function(e, t) {
            return new C.fn.init(e, t)
        };

    function d(e) {
        var t = !!e && "length" in e && e.length,
            n = w(e);
        return !y(e) && !b(e) && ("array" === n || 0 === t || "number" == typeof t && 0 < t && t - 1 in e)
    }
    C.fn = C.prototype = {
        jquery: f,
        constructor: C,
        length: 0,
        toArray: function() {
            return a.call(this)
        },
        get: function(e) {
            return null == e ? a.call(this) : e < 0 ? this[e + this.length] : this[e]
        },
        pushStack: function(e) {
            var t = C.merge(this.constructor(), e);
            return t.prevObject = this, t
        },
        each: function(e) {
            return C.each(this, e)
        },
        map: function(n) {
            return this.pushStack(C.map(this, function(e, t) {
                return n.call(e, t, e)
            }))
        },
        slice: function() {
            return this.pushStack(a.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        even: function() {
            return this.pushStack(C.grep(this, function(e, t) {
                return (t + 1) % 2
            }))
        },
        odd: function() {
            return this.pushStack(C.grep(this, function(e, t) {
                return t % 2
            }))
        },
        eq: function(e) {
            var t = this.length,
                n = +e + (e < 0 ? t : 0);
            return this.pushStack(0 <= n && n < t ? [this[n]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor()
        },
        push: l,
        sort: t.sort,
        splice: t.splice
    }, C.extend = C.fn.extend = function() {
        var e, t, n, i, r, o, s = arguments[0] || {},
            a = 1,
            l = arguments.length,
            u = !1;
        for ("boolean" == typeof s && (u = s, s = arguments[a] || {}, a++), "object" == typeof s || y(s) || (s = {}), a === l && (s = this, a--); a < l; a++)
            if (null != (e = arguments[a]))
                for (t in e) i = e[t], "__proto__" !== t && s !== i && (u && i && (C.isPlainObject(i) || (r = Array.isArray(i))) ? (n = s[t], o = r && !Array.isArray(n) ? [] : r || C.isPlainObject(n) ? n : {}, r = !1, s[t] = C.extend(u, o, i)) : void 0 !== i && (s[t] = i));
        return s
    }, C.extend({
        expando: "jQuery" + (f + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(e) {
            throw new Error(e)
        },
        noop: function() {},
        isPlainObject: function(e) {
            var t, n;
            return !(!e || "[object Object]" !== o.call(e) || (t = i(e)) && ("function" != typeof(n = g.call(t, "constructor") && t.constructor) || s.call(n) !== u))
        },
        isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0
        },
        globalEval: function(e, t, n) {
            _(e, {
                nonce: t && t.nonce
            }, n)
        },
        each: function(e, t) {
            var n, i = 0;
            if (d(e))
                for (n = e.length; i < n && !1 !== t.call(e[i], i, e[i]); i++);
            else
                for (i in e)
                    if (!1 === t.call(e[i], i, e[i])) break;
            return e
        },
        makeArray: function(e, t) {
            var n = t || [];
            return null != e && (d(Object(e)) ? C.merge(n, "string" == typeof e ? [e] : e) : l.call(n, e)), n
        },
        inArray: function(e, t, n) {
            return null == t ? -1 : r.call(t, e, n)
        },
        merge: function(e, t) {
            for (var n = +t.length, i = 0, r = e.length; i < n; i++) e[r++] = t[i];
            return e.length = r, e
        },
        grep: function(e, t, n) {
            for (var i = [], r = 0, o = e.length, s = !n; r < o; r++) !t(e[r], r) !== s && i.push(e[r]);
            return i
        },
        map: function(e, t, n) {
            var i, r, o = 0,
                s = [];
            if (d(e))
                for (i = e.length; o < i; o++) null != (r = t(e[o], o, n)) && s.push(r);
            else
                for (o in e) null != (r = t(e[o], o, n)) && s.push(r);
            return m(s)
        },
        guid: 1,
        support: v
    }), "function" == typeof Symbol && (C.fn[Symbol.iterator] = t[Symbol.iterator]), C.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(e, t) {
        n["[object " + t + "]"] = t.toLowerCase()
    });
    var h = function(n) {
        var e, h, _, o, r, p, f, m, w, l, u, E, x, s, T, g, a, c, v, C = "sizzle" + 1 * new Date,
            d = n.document,
            S = 0,
            i = 0,
            y = le(),
            b = le(),
            D = le(),
            N = le(),
            k = function(e, t) {
                return e === t && (u = !0), 0
            },
            A = {}.hasOwnProperty,
            t = [],
            O = t.pop,
            j = t.push,
            L = t.push,
            I = t.slice,
            P = function(e, t) {
                for (var n = 0, i = e.length; n < i; n++)
                    if (e[n] === t) return n;
                return -1
            },
            q = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            H = "[\\x20\\t\\r\\n\\f]",
            R = "(?:\\\\[\\da-fA-F]{1,6}" + H + "?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+",
            F = "\\[" + H + "*(" + R + ")(?:" + H + "*([*^$|!~]?=)" + H + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + R + "))|)" + H + "*\\]",
            M = ":(" + R + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + F + ")*)|.*)\\)|)",
            B = new RegExp(H + "+", "g"),
            W = new RegExp("^" + H + "+|((?:^|[^\\\\])(?:\\\\.)*)" + H + "+$", "g"),
            U = new RegExp("^" + H + "*," + H + "*"),
            Q = new RegExp("^" + H + "*([>+~]|" + H + ")" + H + "*"),
            $ = new RegExp(H + "|>"),
            z = new RegExp(M),
            V = new RegExp("^" + R + "$"),
            X = {
                ID: new RegExp("^#(" + R + ")"),
                CLASS: new RegExp("^\\.(" + R + ")"),
                TAG: new RegExp("^(" + R + "|[*])"),
                ATTR: new RegExp("^" + F),
                PSEUDO: new RegExp("^" + M),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + H + "*(even|odd|(([+-]|)(\\d*)n|)" + H + "*(?:([+-]|)" + H + "*(\\d+)|))" + H + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + q + ")$", "i"),
                needsContext: new RegExp("^" + H + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + H + "*((?:-\\d)?\\d*)" + H + "*\\)|)(?=[^-]|$)", "i")
            },
            Y = /HTML$/i,
            K = /^(?:input|select|textarea|button)$/i,
            G = /^h\d$/i,
            J = /^[^{]+\{\s*\[native \w/,
            Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            ee = /[+~]/,
            te = new RegExp("\\\\[\\da-fA-F]{1,6}" + H + "?|\\\\([^\\r\\n\\f])", "g"),
            ne = function(e, t) {
                var n = "0x" + e.slice(1) - 65536;
                return t || (n < 0 ? String.fromCharCode(n + 65536) : String.fromCharCode(n >> 10 | 55296, 1023 & n | 56320))
            },
            ie = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
            re = function(e, t) {
                return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
            },
            oe = function() {
                E()
            },
            se = _e(function(e) {
                return !0 === e.disabled && "fieldset" === e.nodeName.toLowerCase()
            }, {
                dir: "parentNode",
                next: "legend"
            });
        try {
            L.apply(t = I.call(d.childNodes), d.childNodes), t[d.childNodes.length].nodeType
        } catch (e) {
            L = {
                apply: t.length ? function(e, t) {
                    j.apply(e, I.call(t))
                } : function(e, t) {
                    for (var n = e.length, i = 0; e[n++] = t[i++];);
                    e.length = n - 1
                }
            }
        }

        function ae(e, t, n, i) {
            var r, o, s, a, l, u, c, f = t && t.ownerDocument,
                d = t ? t.nodeType : 9;
            if (n = n || [], "string" != typeof e || !e || 1 !== d && 9 !== d && 11 !== d) return n;
            if (!i && (E(t), t = t || x, T)) {
                if (11 !== d && (l = Z.exec(e)))
                    if (r = l[1]) {
                        if (9 === d) {
                            if (!(s = t.getElementById(r))) return n;
                            if (s.id === r) return n.push(s), n
                        } else if (f && (s = f.getElementById(r)) && v(t, s) && s.id === r) return n.push(s), n
                    } else {
                        if (l[2]) return L.apply(n, t.getElementsByTagName(e)), n;
                        if ((r = l[3]) && h.getElementsByClassName && t.getElementsByClassName) return L.apply(n, t.getElementsByClassName(r)), n
                    } if (h.qsa && !N[e + " "] && (!g || !g.test(e)) && (1 !== d || "object" !== t.nodeName.toLowerCase())) {
                    if (c = e, f = t, 1 === d && ($.test(e) || Q.test(e))) {
                        for ((f = ee.test(e) && ve(t.parentNode) || t) === t && h.scope || ((a = t.getAttribute("id")) ? a = a.replace(ie, re) : t.setAttribute("id", a = C)), o = (u = p(e)).length; o--;) u[o] = (a ? "#" + a : ":scope") + " " + be(u[o]);
                        c = u.join(",")
                    }
                    try {
                        return L.apply(n, f.querySelectorAll(c)), n
                    } catch (t) {
                        N(e, !0)
                    } finally {
                        a === C && t.removeAttribute("id")
                    }
                }
            }
            return m(e.replace(W, "$1"), t, n, i)
        }

        function le() {
            var i = [];
            return function e(t, n) {
                return i.push(t + " ") > _.cacheLength && delete e[i.shift()], e[t + " "] = n
            }
        }

        function ue(e) {
            return e[C] = !0, e
        }

        function ce(e) {
            var t = x.createElement("fieldset");
            try {
                return !!e(t)
            } catch (e) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function fe(e, t) {
            for (var n = e.split("|"), i = n.length; i--;) _.attrHandle[n[i]] = t
        }

        function de(e, t) {
            var n = t && e,
                i = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
            if (i) return i;
            if (n)
                for (; n = n.nextSibling;)
                    if (n === t) return -1;
            return e ? 1 : -1
        }

        function he(t) {
            return function(e) {
                return "input" === e.nodeName.toLowerCase() && e.type === t
            }
        }

        function pe(n) {
            return function(e) {
                var t = e.nodeName.toLowerCase();
                return ("input" === t || "button" === t) && e.type === n
            }
        }

        function me(t) {
            return function(e) {
                return "form" in e ? e.parentNode && !1 === e.disabled ? "label" in e ? "label" in e.parentNode ? e.parentNode.disabled === t : e.disabled === t : e.isDisabled === t || e.isDisabled !== !t && se(e) === t : e.disabled === t : "label" in e && e.disabled === t
            }
        }

        function ge(s) {
            return ue(function(o) {
                return o = +o, ue(function(e, t) {
                    for (var n, i = s([], e.length, o), r = i.length; r--;) e[n = i[r]] && (e[n] = !(t[n] = e[n]))
                })
            })
        }

        function ve(e) {
            return e && void 0 !== e.getElementsByTagName && e
        }
        for (e in h = ae.support = {}, r = ae.isXML = function(e) {
                var t = e.namespaceURI,
                    n = (e.ownerDocument || e).documentElement;
                return !Y.test(t || n && n.nodeName || "HTML")
            }, E = ae.setDocument = function(e) {
                var t, n, i = e ? e.ownerDocument || e : d;
                return i != x && 9 === i.nodeType && i.documentElement && (s = (x = i).documentElement, T = !r(x), d != x && (n = x.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", oe, !1) : n.attachEvent && n.attachEvent("onunload", oe)), h.scope = ce(function(e) {
                    return s.appendChild(e).appendChild(x.createElement("div")), void 0 !== e.querySelectorAll && !e.querySelectorAll(":scope fieldset div").length
                }), h.attributes = ce(function(e) {
                    return e.className = "i", !e.getAttribute("className")
                }), h.getElementsByTagName = ce(function(e) {
                    return e.appendChild(x.createComment("")), !e.getElementsByTagName("*").length
                }), h.getElementsByClassName = J.test(x.getElementsByClassName), h.getById = ce(function(e) {
                    return s.appendChild(e).id = C, !x.getElementsByName || !x.getElementsByName(C).length
                }), h.getById ? (_.filter.ID = function(e) {
                    var t = e.replace(te, ne);
                    return function(e) {
                        return e.getAttribute("id") === t
                    }
                }, _.find.ID = function(e, t) {
                    if (void 0 !== t.getElementById && T) {
                        var n = t.getElementById(e);
                        return n ? [n] : []
                    }
                }) : (_.filter.ID = function(e) {
                    var n = e.replace(te, ne);
                    return function(e) {
                        var t = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                        return t && t.value === n
                    }
                }, _.find.ID = function(e, t) {
                    if (void 0 !== t.getElementById && T) {
                        var n, i, r, o = t.getElementById(e);
                        if (o) {
                            if ((n = o.getAttributeNode("id")) && n.value === e) return [o];
                            for (r = t.getElementsByName(e), i = 0; o = r[i++];)
                                if ((n = o.getAttributeNode("id")) && n.value === e) return [o]
                        }
                        return []
                    }
                }), _.find.TAG = h.getElementsByTagName ? function(e, t) {
                    return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : h.qsa ? t.querySelectorAll(e) : void 0
                } : function(e, t) {
                    var n, i = [],
                        r = 0,
                        o = t.getElementsByTagName(e);
                    if ("*" !== e) return o;
                    for (; n = o[r++];) 1 === n.nodeType && i.push(n);
                    return i
                }, _.find.CLASS = h.getElementsByClassName && function(e, t) {
                    if (void 0 !== t.getElementsByClassName && T) return t.getElementsByClassName(e)
                }, a = [], g = [], (h.qsa = J.test(x.querySelectorAll)) && (ce(function(e) {
                    var t;
                    s.appendChild(e).innerHTML = "<a id='" + C + "'></a><select id='" + C + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && g.push("[*^$]=" + H + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || g.push("\\[" + H + "*(?:value|" + q + ")"), e.querySelectorAll("[id~=" + C + "-]").length || g.push("~="), (t = x.createElement("input")).setAttribute("name", ""), e.appendChild(t), e.querySelectorAll("[name='']").length || g.push("\\[" + H + "*name" + H + "*=" + H + "*(?:''|\"\")"), e.querySelectorAll(":checked").length || g.push(":checked"), e.querySelectorAll("a#" + C + "+*").length || g.push(".#.+[+~]"), e.querySelectorAll("\\\f"), g.push("[\\r\\n\\f]")
                }), ce(function(e) {
                    e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                    var t = x.createElement("input");
                    t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && g.push("name" + H + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && g.push(":enabled", ":disabled"), s.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && g.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), g.push(",.*:")
                })), (h.matchesSelector = J.test(c = s.matches || s.webkitMatchesSelector || s.mozMatchesSelector || s.oMatchesSelector || s.msMatchesSelector)) && ce(function(e) {
                    h.disconnectedMatch = c.call(e, "*"), c.call(e, "[s!='']:x"), a.push("!=", M)
                }), g = g.length && new RegExp(g.join("|")), a = a.length && new RegExp(a.join("|")), t = J.test(s.compareDocumentPosition), v = t || J.test(s.contains) ? function(e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                        i = t && t.parentNode;
                    return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
                } : function(e, t) {
                    if (t)
                        for (; t = t.parentNode;)
                            if (t === e) return !0;
                    return !1
                }, k = t ? function(e, t) {
                    if (e === t) return u = !0, 0;
                    var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                    return n || (1 & (n = (e.ownerDocument || e) == (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !h.sortDetached && t.compareDocumentPosition(e) === n ? e == x || e.ownerDocument == d && v(d, e) ? -1 : t == x || t.ownerDocument == d && v(d, t) ? 1 : l ? P(l, e) - P(l, t) : 0 : 4 & n ? -1 : 1)
                } : function(e, t) {
                    if (e === t) return u = !0, 0;
                    var n, i = 0,
                        r = e.parentNode,
                        o = t.parentNode,
                        s = [e],
                        a = [t];
                    if (!r || !o) return e == x ? -1 : t == x ? 1 : r ? -1 : o ? 1 : l ? P(l, e) - P(l, t) : 0;
                    if (r === o) return de(e, t);
                    for (n = e; n = n.parentNode;) s.unshift(n);
                    for (n = t; n = n.parentNode;) a.unshift(n);
                    for (; s[i] === a[i];) i++;
                    return i ? de(s[i], a[i]) : s[i] == d ? -1 : a[i] == d ? 1 : 0
                }), x
            }, ae.matches = function(e, t) {
                return ae(e, null, null, t)
            }, ae.matchesSelector = function(e, t) {
                if (E(e), h.matchesSelector && T && !N[t + " "] && (!a || !a.test(t)) && (!g || !g.test(t))) try {
                    var n = c.call(e, t);
                    if (n || h.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n
                } catch (e) {
                    N(t, !0)
                }
                return 0 < ae(t, x, null, [e]).length
            }, ae.contains = function(e, t) {
                return (e.ownerDocument || e) != x && E(e), v(e, t)
            }, ae.attr = function(e, t) {
                (e.ownerDocument || e) != x && E(e);
                var n = _.attrHandle[t.toLowerCase()],
                    i = n && A.call(_.attrHandle, t.toLowerCase()) ? n(e, t, !T) : void 0;
                return void 0 !== i ? i : h.attributes || !T ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
            }, ae.escape = function(e) {
                return (e + "").replace(ie, re)
            }, ae.error = function(e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, ae.uniqueSort = function(e) {
                var t, n = [],
                    i = 0,
                    r = 0;
                if (u = !h.detectDuplicates, l = !h.sortStable && e.slice(0), e.sort(k), u) {
                    for (; t = e[r++];) t === e[r] && (i = n.push(r));
                    for (; i--;) e.splice(n[i], 1)
                }
                return l = null, e
            }, o = ae.getText = function(e) {
                var t, n = "",
                    i = 0,
                    r = e.nodeType;
                if (r) {
                    if (1 === r || 9 === r || 11 === r) {
                        if ("string" == typeof e.textContent) return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) n += o(e)
                    } else if (3 === r || 4 === r) return e.nodeValue
                } else
                    for (; t = e[i++];) n += o(t);
                return n
            }, (_ = ae.selectors = {
                cacheLength: 50,
                createPseudo: ue,
                match: X,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(e) {
                        return e[1] = e[1].replace(te, ne), e[3] = (e[3] || e[4] || e[5] || "").replace(te, ne), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    },
                    CHILD: function(e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || ae.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && ae.error(e[0]), e
                    },
                    PSEUDO: function(e) {
                        var t, n = !e[6] && e[2];
                        return X.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && z.test(n) && (t = p(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(e) {
                        var t = e.replace(te, ne).toLowerCase();
                        return "*" === e ? function() {
                            return !0
                        } : function(e) {
                            return e.nodeName && e.nodeName.toLowerCase() === t
                        }
                    },
                    CLASS: function(e) {
                        var t = y[e + " "];
                        return t || (t = new RegExp("(^|" + H + ")" + e + "(" + H + "|$)")) && y(e, function(e) {
                            return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(n, i, r) {
                        return function(e) {
                            var t = ae.attr(e, n);
                            return null == t ? "!=" === i : !i || (t += "", "=" === i ? t === r : "!=" === i ? t !== r : "^=" === i ? r && 0 === t.indexOf(r) : "*=" === i ? r && -1 < t.indexOf(r) : "$=" === i ? r && t.slice(-r.length) === r : "~=" === i ? -1 < (" " + t.replace(B, " ") + " ").indexOf(r) : "|=" === i && (t === r || t.slice(0, r.length + 1) === r + "-"))
                        }
                    },
                    CHILD: function(p, e, t, m, g) {
                        var v = "nth" !== p.slice(0, 3),
                            y = "last" !== p.slice(-4),
                            b = "of-type" === e;
                        return 1 === m && 0 === g ? function(e) {
                            return !!e.parentNode
                        } : function(e, t, n) {
                            var i, r, o, s, a, l, u = v !== y ? "nextSibling" : "previousSibling",
                                c = e.parentNode,
                                f = b && e.nodeName.toLowerCase(),
                                d = !n && !b,
                                h = !1;
                            if (c) {
                                if (v) {
                                    for (; u;) {
                                        for (s = e; s = s[u];)
                                            if (b ? s.nodeName.toLowerCase() === f : 1 === s.nodeType) return !1;
                                        l = u = "only" === p && !l && "nextSibling"
                                    }
                                    return !0
                                }
                                if (l = [y ? c.firstChild : c.lastChild], y && d) {
                                    for (h = (a = (i = (r = (o = (s = c)[C] || (s[C] = {}))[s.uniqueID] || (o[s.uniqueID] = {}))[p] || [])[0] === S && i[1]) && i[2], s = a && c.childNodes[a]; s = ++a && s && s[u] || (h = a = 0) || l.pop();)
                                        if (1 === s.nodeType && ++h && s === e) {
                                            r[p] = [S, a, h];
                                            break
                                        }
                                } else if (d && (h = a = (i = (r = (o = (s = e)[C] || (s[C] = {}))[s.uniqueID] || (o[s.uniqueID] = {}))[p] || [])[0] === S && i[1]), !1 === h)
                                    for (;
                                        (s = ++a && s && s[u] || (h = a = 0) || l.pop()) && ((b ? s.nodeName.toLowerCase() !== f : 1 !== s.nodeType) || !++h || (d && ((r = (o = s[C] || (s[C] = {}))[s.uniqueID] || (o[s.uniqueID] = {}))[p] = [S, h]), s !== e)););
                                return (h -= g) === m || h % m == 0 && 0 <= h / m
                            }
                        }
                    },
                    PSEUDO: function(e, o) {
                        var t, s = _.pseudos[e] || _.setFilters[e.toLowerCase()] || ae.error("unsupported pseudo: " + e);
                        return s[C] ? s(o) : 1 < s.length ? (t = [e, e, "", o], _.setFilters.hasOwnProperty(e.toLowerCase()) ? ue(function(e, t) {
                            for (var n, i = s(e, o), r = i.length; r--;) e[n = P(e, i[r])] = !(t[n] = i[r])
                        }) : function(e) {
                            return s(e, 0, t)
                        }) : s
                    }
                },
                pseudos: {
                    not: ue(function(e) {
                        var i = [],
                            r = [],
                            a = f(e.replace(W, "$1"));
                        return a[C] ? ue(function(e, t, n, i) {
                            for (var r, o = a(e, null, i, []), s = e.length; s--;)(r = o[s]) && (e[s] = !(t[s] = r))
                        }) : function(e, t, n) {
                            return i[0] = e, a(i, null, n, r), i[0] = null, !r.pop()
                        }
                    }),
                    has: ue(function(t) {
                        return function(e) {
                            return 0 < ae(t, e).length
                        }
                    }),
                    contains: ue(function(t) {
                        return t = t.replace(te, ne),
                            function(e) {
                                return -1 < (e.textContent || o(e)).indexOf(t)
                            }
                    }),
                    lang: ue(function(n) {
                        return V.test(n || "") || ae.error("unsupported lang: " + n), n = n.replace(te, ne).toLowerCase(),
                            function(e) {
                                var t;
                                do {
                                    if (t = T ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (t = t.toLowerCase()) === n || 0 === t.indexOf(n + "-")
                                } while ((e = e.parentNode) && 1 === e.nodeType);
                                return !1
                            }
                    }),
                    target: function(e) {
                        var t = n.location && n.location.hash;
                        return t && t.slice(1) === e.id
                    },
                    root: function(e) {
                        return e === s
                    },
                    focus: function(e) {
                        return e === x.activeElement && (!x.hasFocus || x.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    },
                    enabled: me(!1),
                    disabled: me(!0),
                    checked: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    },
                    selected: function(e) {
                        return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                    },
                    empty: function(e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function(e) {
                        return !_.pseudos.empty(e)
                    },
                    header: function(e) {
                        return G.test(e.nodeName)
                    },
                    input: function(e) {
                        return K.test(e.nodeName)
                    },
                    button: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    },
                    text: function(e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    },
                    first: ge(function() {
                        return [0]
                    }),
                    last: ge(function(e, t) {
                        return [t - 1]
                    }),
                    eq: ge(function(e, t, n) {
                        return [n < 0 ? n + t : n]
                    }),
                    even: ge(function(e, t) {
                        for (var n = 0; n < t; n += 2) e.push(n);
                        return e
                    }),
                    odd: ge(function(e, t) {
                        for (var n = 1; n < t; n += 2) e.push(n);
                        return e
                    }),
                    lt: ge(function(e, t, n) {
                        for (var i = n < 0 ? n + t : t < n ? t : n; 0 <= --i;) e.push(i);
                        return e
                    }),
                    gt: ge(function(e, t, n) {
                        for (var i = n < 0 ? n + t : n; ++i < t;) e.push(i);
                        return e
                    })
                }
            }).pseudos.nth = _.pseudos.eq, {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) _.pseudos[e] = he(e);
        for (e in {
                submit: !0,
                reset: !0
            }) _.pseudos[e] = pe(e);

        function ye() {}

        function be(e) {
            for (var t = 0, n = e.length, i = ""; t < n; t++) i += e[t].value;
            return i
        }

        function _e(a, e, t) {
            var l = e.dir,
                u = e.next,
                c = u || l,
                f = t && "parentNode" === c,
                d = i++;
            return e.first ? function(e, t, n) {
                for (; e = e[l];)
                    if (1 === e.nodeType || f) return a(e, t, n);
                return !1
            } : function(e, t, n) {
                var i, r, o, s = [S, d];
                if (n) {
                    for (; e = e[l];)
                        if ((1 === e.nodeType || f) && a(e, t, n)) return !0
                } else
                    for (; e = e[l];)
                        if (1 === e.nodeType || f)
                            if (r = (o = e[C] || (e[C] = {}))[e.uniqueID] || (o[e.uniqueID] = {}), u && u === e.nodeName.toLowerCase()) e = e[l] || e;
                            else {
                                if ((i = r[c]) && i[0] === S && i[1] === d) return s[2] = i[2];
                                if ((r[c] = s)[2] = a(e, t, n)) return !0
                            } return !1
            }
        }

        function we(r) {
            return 1 < r.length ? function(e, t, n) {
                for (var i = r.length; i--;)
                    if (!r[i](e, t, n)) return !1;
                return !0
            } : r[0]
        }

        function Ee(e, t, n, i, r) {
            for (var o, s = [], a = 0, l = e.length, u = null != t; a < l; a++)(o = e[a]) && (n && !n(o, i, r) || (s.push(o), u && t.push(a)));
            return s
        }

        function xe(h, p, m, g, v, e) {
            return g && !g[C] && (g = xe(g)), v && !v[C] && (v = xe(v, e)), ue(function(e, t, n, i) {
                var r, o, s, a = [],
                    l = [],
                    u = t.length,
                    c = e || function(e, t, n) {
                        for (var i = 0, r = t.length; i < r; i++) ae(e, t[i], n);
                        return n
                    }(p || "*", n.nodeType ? [n] : n, []),
                    f = !h || !e && p ? c : Ee(c, a, h, n, i),
                    d = m ? v || (e ? h : u || g) ? [] : t : f;
                if (m && m(f, d, n, i), g)
                    for (r = Ee(d, l), g(r, [], n, i), o = r.length; o--;)(s = r[o]) && (d[l[o]] = !(f[l[o]] = s));
                if (e) {
                    if (v || h) {
                        if (v) {
                            for (r = [], o = d.length; o--;)(s = d[o]) && r.push(f[o] = s);
                            v(null, d = [], r, i)
                        }
                        for (o = d.length; o--;)(s = d[o]) && -1 < (r = v ? P(e, s) : a[o]) && (e[r] = !(t[r] = s))
                    }
                } else d = Ee(d === t ? d.splice(u, d.length) : d), v ? v(null, t, d, i) : L.apply(t, d)
            })
        }

        function Te(e) {
            for (var r, t, n, i = e.length, o = _.relative[e[0].type], s = o || _.relative[" "], a = o ? 1 : 0, l = _e(function(e) {
                    return e === r
                }, s, !0), u = _e(function(e) {
                    return -1 < P(r, e)
                }, s, !0), c = [function(e, t, n) {
                    var i = !o && (n || t !== w) || ((r = t).nodeType ? l(e, t, n) : u(e, t, n));
                    return r = null, i
                }]; a < i; a++)
                if (t = _.relative[e[a].type]) c = [_e(we(c), t)];
                else {
                    if ((t = _.filter[e[a].type].apply(null, e[a].matches))[C]) {
                        for (n = ++a; n < i && !_.relative[e[n].type]; n++);
                        return xe(1 < a && we(c), 1 < a && be(e.slice(0, a - 1).concat({
                            value: " " === e[a - 2].type ? "*" : ""
                        })).replace(W, "$1"), t, a < n && Te(e.slice(a, n)), n < i && Te(e = e.slice(n)), n < i && be(e))
                    }
                    c.push(t)
                } return we(c)
        }
        return ye.prototype = _.filters = _.pseudos, _.setFilters = new ye, p = ae.tokenize = function(e, t) {
            var n, i, r, o, s, a, l, u = b[e + " "];
            if (u) return t ? 0 : u.slice(0);
            for (s = e, a = [], l = _.preFilter; s;) {
                for (o in n && !(i = U.exec(s)) || (i && (s = s.slice(i[0].length) || s), a.push(r = [])), n = !1, (i = Q.exec(s)) && (n = i.shift(), r.push({
                        value: n,
                        type: i[0].replace(W, " ")
                    }), s = s.slice(n.length)), _.filter) !(i = X[o].exec(s)) || l[o] && !(i = l[o](i)) || (n = i.shift(), r.push({
                    value: n,
                    type: o,
                    matches: i
                }), s = s.slice(n.length));
                if (!n) break
            }
            return t ? s.length : s ? ae.error(e) : b(e, a).slice(0)
        }, f = ae.compile = function(e, t) {
            var n, g, v, y, b, i, r = [],
                o = [],
                s = D[e + " "];
            if (!s) {
                for (t || (t = p(e)), n = t.length; n--;)(s = Te(t[n]))[C] ? r.push(s) : o.push(s);
                (s = D(e, (g = o, y = 0 < (v = r).length, b = 0 < g.length, i = function(e, t, n, i, r) {
                    var o, s, a, l = 0,
                        u = "0",
                        c = e && [],
                        f = [],
                        d = w,
                        h = e || b && _.find.TAG("*", r),
                        p = S += null == d ? 1 : Math.random() || .1,
                        m = h.length;
                    for (r && (w = t == x || t || r); u !== m && null != (o = h[u]); u++) {
                        if (b && o) {
                            for (s = 0, t || o.ownerDocument == x || (E(o), n = !T); a = g[s++];)
                                if (a(o, t || x, n)) {
                                    i.push(o);
                                    break
                                } r && (S = p)
                        }
                        y && ((o = !a && o) && l--, e && c.push(o))
                    }
                    if (l += u, y && u !== l) {
                        for (s = 0; a = v[s++];) a(c, f, t, n);
                        if (e) {
                            if (0 < l)
                                for (; u--;) c[u] || f[u] || (f[u] = O.call(i));
                            f = Ee(f)
                        }
                        L.apply(i, f), r && !e && 0 < f.length && 1 < l + v.length && ae.uniqueSort(i)
                    }
                    return r && (S = p, w = d), c
                }, y ? ue(i) : i))).selector = e
            }
            return s
        }, m = ae.select = function(e, t, n, i) {
            var r, o, s, a, l, u = "function" == typeof e && e,
                c = !i && p(e = u.selector || e);
            if (n = n || [], 1 === c.length) {
                if (2 < (o = c[0] = c[0].slice(0)).length && "ID" === (s = o[0]).type && 9 === t.nodeType && T && _.relative[o[1].type]) {
                    if (!(t = (_.find.ID(s.matches[0].replace(te, ne), t) || [])[0])) return n;
                    u && (t = t.parentNode), e = e.slice(o.shift().value.length)
                }
                for (r = X.needsContext.test(e) ? 0 : o.length; r-- && (s = o[r], !_.relative[a = s.type]);)
                    if ((l = _.find[a]) && (i = l(s.matches[0].replace(te, ne), ee.test(o[0].type) && ve(t.parentNode) || t))) {
                        if (o.splice(r, 1), !(e = i.length && be(o))) return L.apply(n, i), n;
                        break
                    }
            }
            return (u || f(e, c))(i, t, !T, n, !t || ee.test(e) && ve(t.parentNode) || t), n
        }, h.sortStable = C.split("").sort(k).join("") === C, h.detectDuplicates = !!u, E(), h.sortDetached = ce(function(e) {
            return 1 & e.compareDocumentPosition(x.createElement("fieldset"))
        }), ce(function(e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || fe("type|href|height|width", function(e, t, n) {
            if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), h.attributes && ce(function(e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || fe("value", function(e, t, n) {
            if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue
        }), ce(function(e) {
            return null == e.getAttribute("disabled")
        }) || fe(q, function(e, t, n) {
            var i;
            if (!n) return !0 === e[t] ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }), ae
    }(x);
    C.find = h, C.expr = h.selectors, C.expr[":"] = C.expr.pseudos, C.uniqueSort = C.unique = h.uniqueSort, C.text = h.getText, C.isXMLDoc = h.isXML, C.contains = h.contains, C.escapeSelector = h.escape;
    var p = function(e, t, n) {
            for (var i = [], r = void 0 !== n;
                (e = e[t]) && 9 !== e.nodeType;)
                if (1 === e.nodeType) {
                    if (r && C(e).is(n)) break;
                    i.push(e)
                } return i
        },
        E = function(e, t) {
            for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n
        },
        S = C.expr.match.needsContext;

    function D(e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
    }
    var N = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;

    function k(e, n, i) {
        return y(n) ? C.grep(e, function(e, t) {
            return !!n.call(e, t, e) !== i
        }) : n.nodeType ? C.grep(e, function(e) {
            return e === n !== i
        }) : "string" != typeof n ? C.grep(e, function(e) {
            return -1 < r.call(n, e) !== i
        }) : C.filter(n, e, i)
    }
    C.filter = function(e, t, n) {
        var i = t[0];
        return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? C.find.matchesSelector(i, e) ? [i] : [] : C.find.matches(e, C.grep(t, function(e) {
            return 1 === e.nodeType
        }))
    }, C.fn.extend({
        find: function(e) {
            var t, n, i = this.length,
                r = this;
            if ("string" != typeof e) return this.pushStack(C(e).filter(function() {
                for (t = 0; t < i; t++)
                    if (C.contains(r[t], this)) return !0
            }));
            for (n = this.pushStack([]), t = 0; t < i; t++) C.find(e, r[t], n);
            return 1 < i ? C.uniqueSort(n) : n
        },
        filter: function(e) {
            return this.pushStack(k(this, e || [], !1))
        },
        not: function(e) {
            return this.pushStack(k(this, e || [], !0))
        },
        is: function(e) {
            return !!k(this, "string" == typeof e && S.test(e) ? C(e) : e || [], !1).length
        }
    });
    var A, O = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (C.fn.init = function(e, t, n) {
        var i, r;
        if (!e) return this;
        if (n = n || A, "string" != typeof e) return e.nodeType ? (this[0] = e, this.length = 1, this) : y(e) ? void 0 !== n.ready ? n.ready(e) : e(C) : C.makeArray(e, this);
        if (!(i = "<" === e[0] && ">" === e[e.length - 1] && 3 <= e.length ? [null, e, null] : O.exec(e)) || !i[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
        if (i[1]) {
            if (t = t instanceof C ? t[0] : t, C.merge(this, C.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : T, !0)), N.test(i[1]) && C.isPlainObject(t))
                for (i in t) y(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
            return this
        }
        return (r = T.getElementById(i[2])) && (this[0] = r, this.length = 1), this
    }).prototype = C.fn, A = C(T);
    var j = /^(?:parents|prev(?:Until|All))/,
        L = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };

    function I(e, t) {
        for (;
            (e = e[t]) && 1 !== e.nodeType;);
        return e
    }
    C.fn.extend({
        has: function(e) {
            var t = C(e, this),
                n = t.length;
            return this.filter(function() {
                for (var e = 0; e < n; e++)
                    if (C.contains(this, t[e])) return !0
            })
        },
        closest: function(e, t) {
            var n, i = 0,
                r = this.length,
                o = [],
                s = "string" != typeof e && C(e);
            if (!S.test(e))
                for (; i < r; i++)
                    for (n = this[i]; n && n !== t; n = n.parentNode)
                        if (n.nodeType < 11 && (s ? -1 < s.index(n) : 1 === n.nodeType && C.find.matchesSelector(n, e))) {
                            o.push(n);
                            break
                        } return this.pushStack(1 < o.length ? C.uniqueSort(o) : o)
        },
        index: function(e) {
            return e ? "string" == typeof e ? r.call(C(e), this[0]) : r.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(e, t) {
            return this.pushStack(C.uniqueSort(C.merge(this.get(), C(e, t))))
        },
        addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), C.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function(e) {
            return p(e, "parentNode")
        },
        parentsUntil: function(e, t, n) {
            return p(e, "parentNode", n)
        },
        next: function(e) {
            return I(e, "nextSibling")
        },
        prev: function(e) {
            return I(e, "previousSibling")
        },
        nextAll: function(e) {
            return p(e, "nextSibling")
        },
        prevAll: function(e) {
            return p(e, "previousSibling")
        },
        nextUntil: function(e, t, n) {
            return p(e, "nextSibling", n)
        },
        prevUntil: function(e, t, n) {
            return p(e, "previousSibling", n)
        },
        siblings: function(e) {
            return E((e.parentNode || {}).firstChild, e)
        },
        children: function(e) {
            return E(e.firstChild)
        },
        contents: function(e) {
            return null != e.contentDocument && i(e.contentDocument) ? e.contentDocument : (D(e, "template") && (e = e.content || e), C.merge([], e.childNodes))
        }
    }, function(i, r) {
        C.fn[i] = function(e, t) {
            var n = C.map(this, r, e);
            return "Until" !== i.slice(-5) && (t = e), t && "string" == typeof t && (n = C.filter(t, n)), 1 < this.length && (L[i] || C.uniqueSort(n), j.test(i) && n.reverse()), this.pushStack(n)
        }
    });
    var P = /[^\x20\t\r\n\f]+/g;

    function q(e) {
        return e
    }

    function H(e) {
        throw e
    }

    function R(e, t, n, i) {
        var r;
        try {
            e && y(r = e.promise) ? r.call(e).done(t).fail(n) : e && y(r = e.then) ? r.call(e, t, n) : t.apply(void 0, [e].slice(i))
        } catch (e) {
            n.apply(void 0, [e])
        }
    }
    C.Callbacks = function(i) {
        var e, n;
        i = "string" == typeof i ? (e = i, n = {}, C.each(e.match(P) || [], function(e, t) {
            n[t] = !0
        }), n) : C.extend({}, i);
        var r, t, o, s, a = [],
            l = [],
            u = -1,
            c = function() {
                for (s = s || i.once, o = r = !0; l.length; u = -1)
                    for (t = l.shift(); ++u < a.length;) !1 === a[u].apply(t[0], t[1]) && i.stopOnFalse && (u = a.length, t = !1);
                i.memory || (t = !1), r = !1, s && (a = t ? [] : "")
            },
            f = {
                add: function() {
                    return a && (t && !r && (u = a.length - 1, l.push(t)), function n(e) {
                        C.each(e, function(e, t) {
                            y(t) ? i.unique && f.has(t) || a.push(t) : t && t.length && "string" !== w(t) && n(t)
                        })
                    }(arguments), t && !r && c()), this
                },
                remove: function() {
                    return C.each(arguments, function(e, t) {
                        for (var n; - 1 < (n = C.inArray(t, a, n));) a.splice(n, 1), n <= u && u--
                    }), this
                },
                has: function(e) {
                    return e ? -1 < C.inArray(e, a) : 0 < a.length
                },
                empty: function() {
                    return a && (a = []), this
                },
                disable: function() {
                    return s = l = [], a = t = "", this
                },
                disabled: function() {
                    return !a
                },
                lock: function() {
                    return s = l = [], t || r || (a = t = ""), this
                },
                locked: function() {
                    return !!s
                },
                fireWith: function(e, t) {
                    return s || (t = [e, (t = t || []).slice ? t.slice() : t], l.push(t), r || c()), this
                },
                fire: function() {
                    return f.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!o
                }
            };
        return f
    }, C.extend({
        Deferred: function(e) {
            var o = [
                    ["notify", "progress", C.Callbacks("memory"), C.Callbacks("memory"), 2],
                    ["resolve", "done", C.Callbacks("once memory"), C.Callbacks("once memory"), 0, "resolved"],
                    ["reject", "fail", C.Callbacks("once memory"), C.Callbacks("once memory"), 1, "rejected"]
                ],
                r = "pending",
                s = {
                    state: function() {
                        return r
                    },
                    always: function() {
                        return a.done(arguments).fail(arguments), this
                    },
                    catch: function(e) {
                        return s.then(null, e)
                    },
                    pipe: function() {
                        var r = arguments;
                        return C.Deferred(function(i) {
                            C.each(o, function(e, t) {
                                var n = y(r[t[4]]) && r[t[4]];
                                a[t[1]](function() {
                                    var e = n && n.apply(this, arguments);
                                    e && y(e.promise) ? e.promise().progress(i.notify).done(i.resolve).fail(i.reject) : i[t[0] + "With"](this, n ? [e] : arguments)
                                })
                            }), r = null
                        }).promise()
                    },
                    then: function(t, n, i) {
                        var l = 0;

                        function u(r, o, s, a) {
                            return function() {
                                var n = this,
                                    i = arguments,
                                    e = function() {
                                        var e, t;
                                        if (!(r < l)) {
                                            if ((e = s.apply(n, i)) === o.promise()) throw new TypeError("Thenable self-resolution");
                                            t = e && ("object" == typeof e || "function" == typeof e) && e.then, y(t) ? a ? t.call(e, u(l, o, q, a), u(l, o, H, a)) : (l++, t.call(e, u(l, o, q, a), u(l, o, H, a), u(l, o, q, o.notifyWith))) : (s !== q && (n = void 0, i = [e]), (a || o.resolveWith)(n, i))
                                        }
                                    },
                                    t = a ? e : function() {
                                        try {
                                            e()
                                        } catch (e) {
                                            C.Deferred.exceptionHook && C.Deferred.exceptionHook(e, t.stackTrace), l <= r + 1 && (s !== H && (n = void 0, i = [e]), o.rejectWith(n, i))
                                        }
                                    };
                                r ? t() : (C.Deferred.getStackHook && (t.stackTrace = C.Deferred.getStackHook()), x.setTimeout(t))
                            }
                        }
                        return C.Deferred(function(e) {
                            o[0][3].add(u(0, e, y(i) ? i : q, e.notifyWith)), o[1][3].add(u(0, e, y(t) ? t : q)), o[2][3].add(u(0, e, y(n) ? n : H))
                        }).promise()
                    },
                    promise: function(e) {
                        return null != e ? C.extend(e, s) : s
                    }
                },
                a = {};
            return C.each(o, function(e, t) {
                var n = t[2],
                    i = t[5];
                s[t[1]] = n.add, i && n.add(function() {
                    r = i
                }, o[3 - e][2].disable, o[3 - e][3].disable, o[0][2].lock, o[0][3].lock), n.add(t[3].fire), a[t[0]] = function() {
                    return a[t[0] + "With"](this === a ? void 0 : this, arguments), this
                }, a[t[0] + "With"] = n.fireWith
            }), s.promise(a), e && e.call(a, a), a
        },
        when: function(e) {
            var n = arguments.length,
                t = n,
                i = Array(t),
                r = a.call(arguments),
                o = C.Deferred(),
                s = function(t) {
                    return function(e) {
                        i[t] = this, r[t] = 1 < arguments.length ? a.call(arguments) : e, --n || o.resolveWith(i, r)
                    }
                };
            if (n <= 1 && (R(e, o.done(s(t)).resolve, o.reject, !n), "pending" === o.state() || y(r[t] && r[t].then))) return o.then();
            for (; t--;) R(r[t], s(t), o.reject);
            return o.promise()
        }
    });
    var F = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    C.Deferred.exceptionHook = function(e, t) {
        x.console && x.console.warn && e && F.test(e.name) && x.console.warn("jQuery.Deferred exception: " + e.message, e.stack, t)
    }, C.readyException = function(e) {
        x.setTimeout(function() {
            throw e
        })
    };
    var M = C.Deferred();

    function B() {
        T.removeEventListener("DOMContentLoaded", B), x.removeEventListener("load", B), C.ready()
    }
    C.fn.ready = function(e) {
        return M.then(e).catch(function(e) {
            C.readyException(e)
        }), this
    }, C.extend({
        isReady: !1,
        readyWait: 1,
        ready: function(e) {
            (!0 === e ? --C.readyWait : C.isReady) || (C.isReady = !0) !== e && 0 < --C.readyWait || M.resolveWith(T, [C])
        }
    }), C.ready.then = M.then, "complete" === T.readyState || "loading" !== T.readyState && !T.documentElement.doScroll ? x.setTimeout(C.ready) : (T.addEventListener("DOMContentLoaded", B), x.addEventListener("load", B));
    var W = function(e, t, n, i, r, o, s) {
            var a = 0,
                l = e.length,
                u = null == n;
            if ("object" === w(n))
                for (a in r = !0, n) W(e, t, a, n[a], !0, o, s);
            else if (void 0 !== i && (r = !0, y(i) || (s = !0), u && (t = s ? (t.call(e, i), null) : (u = t, function(e, t, n) {
                    return u.call(C(e), n)
                })), t))
                for (; a < l; a++) t(e[a], n, s ? i : i.call(e[a], a, t(e[a], n)));
            return r ? e : u ? t.call(e) : l ? t(e[0], n) : o
        },
        U = /^-ms-/,
        Q = /-([a-z])/g;

    function $(e, t) {
        return t.toUpperCase()
    }

    function z(e) {
        return e.replace(U, "ms-").replace(Q, $)
    }
    var V = function(e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
    };

    function X() {
        this.expando = C.expando + X.uid++
    }
    X.uid = 1, X.prototype = {
        cache: function(e) {
            var t = e[this.expando];
            return t || (t = {}, V(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                value: t,
                configurable: !0
            }))), t
        },
        set: function(e, t, n) {
            var i, r = this.cache(e);
            if ("string" == typeof t) r[z(t)] = n;
            else
                for (i in t) r[z(i)] = t[i];
            return r
        },
        get: function(e, t) {
            return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][z(t)]
        },
        access: function(e, t, n) {
            return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
        },
        remove: function(e, t) {
            var n, i = e[this.expando];
            if (void 0 !== i) {
                if (void 0 !== t) {
                    n = (t = Array.isArray(t) ? t.map(z) : (t = z(t)) in i ? [t] : t.match(P) || []).length;
                    for (; n--;) delete i[t[n]]
                }(void 0 === t || C.isEmptyObject(i)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
            }
        },
        hasData: function(e) {
            var t = e[this.expando];
            return void 0 !== t && !C.isEmptyObject(t)
        }
    };
    var Y = new X,
        K = new X,
        G = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        J = /[A-Z]/g;

    function Z(e, t, n) {
        var i, r;
        if (void 0 === n && 1 === e.nodeType)
            if (i = "data-" + t.replace(J, "-$&").toLowerCase(), "string" == typeof(n = e.getAttribute(i))) {
                try {
                    n = "true" === (r = n) || "false" !== r && ("null" === r ? null : r === +r + "" ? +r : G.test(r) ? JSON.parse(r) : r)
                } catch (e) {}
                K.set(e, t, n)
            } else n = void 0;
        return n
    }
    C.extend({
        hasData: function(e) {
            return K.hasData(e) || Y.hasData(e)
        },
        data: function(e, t, n) {
            return K.access(e, t, n)
        },
        removeData: function(e, t) {
            K.remove(e, t)
        },
        _data: function(e, t, n) {
            return Y.access(e, t, n)
        },
        _removeData: function(e, t) {
            Y.remove(e, t)
        }
    }), C.fn.extend({
        data: function(n, e) {
            var t, i, r, o = this[0],
                s = o && o.attributes;
            if (void 0 !== n) return "object" == typeof n ? this.each(function() {
                K.set(this, n)
            }) : W(this, function(e) {
                var t;
                if (o && void 0 === e) return void 0 !== (t = K.get(o, n)) ? t : void 0 !== (t = Z(o, n)) ? t : void 0;
                this.each(function() {
                    K.set(this, n, e)
                })
            }, null, e, 1 < arguments.length, null, !0);
            if (this.length && (r = K.get(o), 1 === o.nodeType && !Y.get(o, "hasDataAttrs"))) {
                for (t = s.length; t--;) s[t] && 0 === (i = s[t].name).indexOf("data-") && (i = z(i.slice(5)), Z(o, i, r[i]));
                Y.set(o, "hasDataAttrs", !0)
            }
            return r
        },
        removeData: function(e) {
            return this.each(function() {
                K.remove(this, e)
            })
        }
    }), C.extend({
        queue: function(e, t, n) {
            var i;
            if (e) return t = (t || "fx") + "queue", i = Y.get(e, t), n && (!i || Array.isArray(n) ? i = Y.access(e, t, C.makeArray(n)) : i.push(n)), i || []
        },
        dequeue: function(e, t) {
            t = t || "fx";
            var n = C.queue(e, t),
                i = n.length,
                r = n.shift(),
                o = C._queueHooks(e, t);
            "inprogress" === r && (r = n.shift(), i--), r && ("fx" === t && n.unshift("inprogress"), delete o.stop, r.call(e, function() {
                C.dequeue(e, t)
            }, o)), !i && o && o.empty.fire()
        },
        _queueHooks: function(e, t) {
            var n = t + "queueHooks";
            return Y.get(e, n) || Y.access(e, n, {
                empty: C.Callbacks("once memory").add(function() {
                    Y.remove(e, [t + "queue", n])
                })
            })
        }
    }), C.fn.extend({
        queue: function(t, n) {
            var e = 2;
            return "string" != typeof t && (n = t, t = "fx", e--), arguments.length < e ? C.queue(this[0], t) : void 0 === n ? this : this.each(function() {
                var e = C.queue(this, t, n);
                C._queueHooks(this, t), "fx" === t && "inprogress" !== e[0] && C.dequeue(this, t)
            })
        },
        dequeue: function(e) {
            return this.each(function() {
                C.dequeue(this, e)
            })
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", [])
        },
        promise: function(e, t) {
            var n, i = 1,
                r = C.Deferred(),
                o = this,
                s = this.length,
                a = function() {
                    --i || r.resolveWith(o, [o])
                };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; s--;)(n = Y.get(o[s], e + "queueHooks")) && n.empty && (i++, n.empty.add(a));
            return a(), r.promise(t)
        }
    });
    var ee = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        te = new RegExp("^(?:([+-])=|)(" + ee + ")([a-z%]*)$", "i"),
        ne = ["Top", "Right", "Bottom", "Left"],
        ie = T.documentElement,
        re = function(e) {
            return C.contains(e.ownerDocument, e)
        },
        oe = {
            composed: !0
        };
    ie.getRootNode && (re = function(e) {
        return C.contains(e.ownerDocument, e) || e.getRootNode(oe) === e.ownerDocument
    });
    var se = function(e, t) {
        return "none" === (e = t || e).style.display || "" === e.style.display && re(e) && "none" === C.css(e, "display")
    };

    function ae(e, t, n, i) {
        var r, o, s = 20,
            a = i ? function() {
                return i.cur()
            } : function() {
                return C.css(e, t, "")
            },
            l = a(),
            u = n && n[3] || (C.cssNumber[t] ? "" : "px"),
            c = e.nodeType && (C.cssNumber[t] || "px" !== u && +l) && te.exec(C.css(e, t));
        if (c && c[3] !== u) {
            for (l /= 2, u = u || c[3], c = +l || 1; s--;) C.style(e, t, c + u), (1 - o) * (1 - (o = a() / l || .5)) <= 0 && (s = 0), c /= o;
            c *= 2, C.style(e, t, c + u), n = n || []
        }
        return n && (c = +c || +l || 0, r = n[1] ? c + (n[1] + 1) * n[2] : +n[2], i && (i.unit = u, i.start = c, i.end = r)), r
    }
    var le = {};

    function ue(e, t) {
        for (var n, i, r, o, s, a, l, u = [], c = 0, f = e.length; c < f; c++)(i = e[c]).style && (n = i.style.display, t ? ("none" === n && (u[c] = Y.get(i, "display") || null, u[c] || (i.style.display = "")), "" === i.style.display && se(i) && (u[c] = (l = s = o = void 0, s = (r = i).ownerDocument, a = r.nodeName, (l = le[a]) || (o = s.body.appendChild(s.createElement(a)), l = C.css(o, "display"), o.parentNode.removeChild(o), "none" === l && (l = "block"), le[a] = l)))) : "none" !== n && (u[c] = "none", Y.set(i, "display", n)));
        for (c = 0; c < f; c++) null != u[c] && (e[c].style.display = u[c]);
        return e
    }
    C.fn.extend({
        show: function() {
            return ue(this, !0)
        },
        hide: function() {
            return ue(this)
        },
        toggle: function(e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
                se(this) ? C(this).show() : C(this).hide()
            })
        }
    });
    var ce, fe, de = /^(?:checkbox|radio)$/i,
        he = /<([a-z][^\/\0>\x20\t\r\n\f]*)/i,
        pe = /^$|^module$|\/(?:java|ecma)script/i;
    ce = T.createDocumentFragment().appendChild(T.createElement("div")), (fe = T.createElement("input")).setAttribute("type", "radio"), fe.setAttribute("checked", "checked"), fe.setAttribute("name", "t"), ce.appendChild(fe), v.checkClone = ce.cloneNode(!0).cloneNode(!0).lastChild.checked, ce.innerHTML = "<textarea>x</textarea>", v.noCloneChecked = !!ce.cloneNode(!0).lastChild.defaultValue, ce.innerHTML = "<option></option>", v.option = !!ce.lastChild;
    var me = {
        thead: [1, "<table>", "</table>"],
        col: [2, "<table><colgroup>", "</colgroup></table>"],
        tr: [2, "<table><tbody>", "</tbody></table>"],
        td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
        _default: [0, "", ""]
    };

    function ge(e, t) {
        var n;
        return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && D(e, t) ? C.merge([e], n) : n
    }

    function ve(e, t) {
        for (var n = 0, i = e.length; n < i; n++) Y.set(e[n], "globalEval", !t || Y.get(t[n], "globalEval"))
    }
    me.tbody = me.tfoot = me.colgroup = me.caption = me.thead, me.th = me.td, v.option || (me.optgroup = me.option = [1, "<select multiple='multiple'>", "</select>"]);
    var ye = /<|&#?\w+;/;

    function be(e, t, n, i, r) {
        for (var o, s, a, l, u, c, f = t.createDocumentFragment(), d = [], h = 0, p = e.length; h < p; h++)
            if ((o = e[h]) || 0 === o)
                if ("object" === w(o)) C.merge(d, o.nodeType ? [o] : o);
                else if (ye.test(o)) {
            for (s = s || f.appendChild(t.createElement("div")), a = (he.exec(o) || ["", ""])[1].toLowerCase(), l = me[a] || me._default, s.innerHTML = l[1] + C.htmlPrefilter(o) + l[2], c = l[0]; c--;) s = s.lastChild;
            C.merge(d, s.childNodes), (s = f.firstChild).textContent = ""
        } else d.push(t.createTextNode(o));
        for (f.textContent = "", h = 0; o = d[h++];)
            if (i && -1 < C.inArray(o, i)) r && r.push(o);
            else if (u = re(o), s = ge(f.appendChild(o), "script"), u && ve(s), n)
            for (c = 0; o = s[c++];) pe.test(o.type || "") && n.push(o);
        return f
    }
    var _e = /^key/,
        we = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        Ee = /^([^.]*)(?:\.(.+)|)/;

    function xe() {
        return !0
    }

    function Te() {
        return !1
    }

    function Ce(e, t) {
        return e === function() {
            try {
                return T.activeElement
            } catch (e) {}
        }() == ("focus" === t)
    }

    function Se(e, t, n, i, r, o) {
        var s, a;
        if ("object" == typeof t) {
            for (a in "string" != typeof n && (i = i || n, n = void 0), t) Se(e, a, n, i, t[a], o);
            return e
        }
        if (null == i && null == r ? (r = n, i = n = void 0) : null == r && ("string" == typeof n ? (r = i, i = void 0) : (r = i, i = n, n = void 0)), !1 === r) r = Te;
        else if (!r) return e;
        return 1 === o && (s = r, (r = function(e) {
            return C().off(e), s.apply(this, arguments)
        }).guid = s.guid || (s.guid = C.guid++)), e.each(function() {
            C.event.add(this, t, r, i, n)
        })
    }

    function De(e, r, o) {
        o ? (Y.set(e, r, !1), C.event.add(e, r, {
            namespace: !1,
            handler: function(e) {
                var t, n, i = Y.get(this, r);
                if (1 & e.isTrigger && this[r]) {
                    if (i.length)(C.event.special[r] || {}).delegateType && e.stopPropagation();
                    else if (i = a.call(arguments), Y.set(this, r, i), t = o(this, r), this[r](), i !== (n = Y.get(this, r)) || t ? Y.set(this, r, !1) : n = {}, i !== n) return e.stopImmediatePropagation(), e.preventDefault(), n.value
                } else i.length && (Y.set(this, r, {
                    value: C.event.trigger(C.extend(i[0], C.Event.prototype), i.slice(1), this)
                }), e.stopImmediatePropagation())
            }
        })) : void 0 === Y.get(e, r) && C.event.add(e, r, xe)
    }
    C.event = {
        global: {},
        add: function(t, e, n, i, r) {
            var o, s, a, l, u, c, f, d, h, p, m, g = Y.get(t);
            if (V(t))
                for (n.handler && (n = (o = n).handler, r = o.selector), r && C.find.matchesSelector(ie, r), n.guid || (n.guid = C.guid++), (l = g.events) || (l = g.events = Object.create(null)), (s = g.handle) || (s = g.handle = function(e) {
                        return void 0 !== C && C.event.triggered !== e.type ? C.event.dispatch.apply(t, arguments) : void 0
                    }), u = (e = (e || "").match(P) || [""]).length; u--;) h = m = (a = Ee.exec(e[u]) || [])[1], p = (a[2] || "").split(".").sort(), h && (f = C.event.special[h] || {}, h = (r ? f.delegateType : f.bindType) || h, f = C.event.special[h] || {}, c = C.extend({
                    type: h,
                    origType: m,
                    data: i,
                    handler: n,
                    guid: n.guid,
                    selector: r,
                    needsContext: r && C.expr.match.needsContext.test(r),
                    namespace: p.join(".")
                }, o), (d = l[h]) || ((d = l[h] = []).delegateCount = 0, f.setup && !1 !== f.setup.call(t, i, p, s) || t.addEventListener && t.addEventListener(h, s)), f.add && (f.add.call(t, c), c.handler.guid || (c.handler.guid = n.guid)), r ? d.splice(d.delegateCount++, 0, c) : d.push(c), C.event.global[h] = !0)
        },
        remove: function(e, t, n, i, r) {
            var o, s, a, l, u, c, f, d, h, p, m, g = Y.hasData(e) && Y.get(e);
            if (g && (l = g.events)) {
                for (u = (t = (t || "").match(P) || [""]).length; u--;)
                    if (h = m = (a = Ee.exec(t[u]) || [])[1], p = (a[2] || "").split(".").sort(), h) {
                        for (f = C.event.special[h] || {}, d = l[h = (i ? f.delegateType : f.bindType) || h] || [], a = a[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), s = o = d.length; o--;) c = d[o], !r && m !== c.origType || n && n.guid !== c.guid || a && !a.test(c.namespace) || i && i !== c.selector && ("**" !== i || !c.selector) || (d.splice(o, 1), c.selector && d.delegateCount--, f.remove && f.remove.call(e, c));
                        s && !d.length && (f.teardown && !1 !== f.teardown.call(e, p, g.handle) || C.removeEvent(e, h, g.handle), delete l[h])
                    } else
                        for (h in l) C.event.remove(e, h + t[u], n, i, !0);
                C.isEmptyObject(l) && Y.remove(e, "handle events")
            }
        },
        dispatch: function(e) {
            var t, n, i, r, o, s, a = new Array(arguments.length),
                l = C.event.fix(e),
                u = (Y.get(this, "events") || Object.create(null))[l.type] || [],
                c = C.event.special[l.type] || {};
            for (a[0] = l, t = 1; t < arguments.length; t++) a[t] = arguments[t];
            if (l.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, l)) {
                for (s = C.event.handlers.call(this, l, u), t = 0;
                    (r = s[t++]) && !l.isPropagationStopped();)
                    for (l.currentTarget = r.elem, n = 0;
                        (o = r.handlers[n++]) && !l.isImmediatePropagationStopped();) l.rnamespace && !1 !== o.namespace && !l.rnamespace.test(o.namespace) || (l.handleObj = o, l.data = o.data, void 0 !== (i = ((C.event.special[o.origType] || {}).handle || o.handler).apply(r.elem, a)) && !1 === (l.result = i) && (l.preventDefault(), l.stopPropagation()));
                return c.postDispatch && c.postDispatch.call(this, l), l.result
            }
        },
        handlers: function(e, t) {
            var n, i, r, o, s, a = [],
                l = t.delegateCount,
                u = e.target;
            if (l && u.nodeType && !("click" === e.type && 1 <= e.button))
                for (; u !== this; u = u.parentNode || this)
                    if (1 === u.nodeType && ("click" !== e.type || !0 !== u.disabled)) {
                        for (o = [], s = {}, n = 0; n < l; n++) void 0 === s[r = (i = t[n]).selector + " "] && (s[r] = i.needsContext ? -1 < C(r, this).index(u) : C.find(r, this, null, [u]).length), s[r] && o.push(i);
                        o.length && a.push({
                            elem: u,
                            handlers: o
                        })
                    } return u = this, l < t.length && a.push({
                elem: u,
                handlers: t.slice(l)
            }), a
        },
        addProp: function(t, e) {
            Object.defineProperty(C.Event.prototype, t, {
                enumerable: !0,
                configurable: !0,
                get: y(e) ? function() {
                    if (this.originalEvent) return e(this.originalEvent)
                } : function() {
                    if (this.originalEvent) return this.originalEvent[t]
                },
                set: function(e) {
                    Object.defineProperty(this, t, {
                        enumerable: !0,
                        configurable: !0,
                        writable: !0,
                        value: e
                    })
                }
            })
        },
        fix: function(e) {
            return e[C.expando] ? e : new C.Event(e)
        },
        special: {
            load: {
                noBubble: !0
            },
            click: {
                setup: function(e) {
                    var t = this || e;
                    return de.test(t.type) && t.click && D(t, "input") && De(t, "click", xe), !1
                },
                trigger: function(e) {
                    var t = this || e;
                    return de.test(t.type) && t.click && D(t, "input") && De(t, "click"), !0
                },
                _default: function(e) {
                    var t = e.target;
                    return de.test(t.type) && t.click && D(t, "input") && Y.get(t, "click") || D(t, "a")
                }
            },
            beforeunload: {
                postDispatch: function(e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        }
    }, C.removeEvent = function(e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n)
    }, C.Event = function(e, t) {
        if (!(this instanceof C.Event)) return new C.Event(e, t);
        e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? xe : Te, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && C.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[C.expando] = !0
    }, C.Event.prototype = {
        constructor: C.Event,
        isDefaultPrevented: Te,
        isPropagationStopped: Te,
        isImmediatePropagationStopped: Te,
        isSimulated: !1,
        preventDefault: function() {
            var e = this.originalEvent;
            this.isDefaultPrevented = xe, e && !this.isSimulated && e.preventDefault()
        },
        stopPropagation: function() {
            var e = this.originalEvent;
            this.isPropagationStopped = xe, e && !this.isSimulated && e.stopPropagation()
        },
        stopImmediatePropagation: function() {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = xe, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, C.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        code: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function(e) {
            var t = e.button;
            return null == e.which && _e.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && we.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
        }
    }, C.event.addProp), C.each({
        focus: "focusin",
        blur: "focusout"
    }, function(e, t) {
        C.event.special[e] = {
            setup: function() {
                return De(this, e, Ce), !1
            },
            trigger: function() {
                return De(this, e), !0
            },
            delegateType: t
        }
    }), C.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function(e, r) {
        C.event.special[e] = {
            delegateType: r,
            bindType: r,
            handle: function(e) {
                var t, n = e.relatedTarget,
                    i = e.handleObj;
                return n && (n === this || C.contains(this, n)) || (e.type = i.origType, t = i.handler.apply(this, arguments), e.type = r), t
            }
        }
    }), C.fn.extend({
        on: function(e, t, n, i) {
            return Se(this, e, t, n, i)
        },
        one: function(e, t, n, i) {
            return Se(this, e, t, n, i, 1)
        },
        off: function(e, t, n) {
            var i, r;
            if (e && e.preventDefault && e.handleObj) return i = e.handleObj, C(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" != typeof e) return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = Te), this.each(function() {
                C.event.remove(this, e, n, t)
            });
            for (r in e) this.off(r, t, e[r]);
            return this
        }
    });
    var Ne = /<script|<style|<link/i,
        ke = /checked\s*(?:[^=]|=\s*.checked.)/i,
        Ae = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

    function Oe(e, t) {
        return D(e, "table") && D(11 !== t.nodeType ? t : t.firstChild, "tr") && C(e).children("tbody")[0] || e
    }

    function je(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
    }

    function Le(e) {
        return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e
    }

    function Ie(e, t) {
        var n, i, r, o, s, a;
        if (1 === t.nodeType) {
            if (Y.hasData(e) && (a = Y.get(e).events))
                for (r in Y.remove(t, "handle events"), a)
                    for (n = 0, i = a[r].length; n < i; n++) C.event.add(t, r, a[r][n]);
            K.hasData(e) && (o = K.access(e), s = C.extend({}, o), K.set(t, s))
        }
    }

    function Pe(n, i, r, o) {
        i = m(i);
        var e, t, s, a, l, u, c = 0,
            f = n.length,
            d = f - 1,
            h = i[0],
            p = y(h);
        if (p || 1 < f && "string" == typeof h && !v.checkClone && ke.test(h)) return n.each(function(e) {
            var t = n.eq(e);
            p && (i[0] = h.call(this, e, t.html())), Pe(t, i, r, o)
        });
        if (f && (t = (e = be(i, n[0].ownerDocument, !1, n, o)).firstChild, 1 === e.childNodes.length && (e = t), t || o)) {
            for (a = (s = C.map(ge(e, "script"), je)).length; c < f; c++) l = e, c !== d && (l = C.clone(l, !0, !0), a && C.merge(s, ge(l, "script"))), r.call(n[c], l, c);
            if (a)
                for (u = s[s.length - 1].ownerDocument, C.map(s, Le), c = 0; c < a; c++) l = s[c], pe.test(l.type || "") && !Y.access(l, "globalEval") && C.contains(u, l) && (l.src && "module" !== (l.type || "").toLowerCase() ? C._evalUrl && !l.noModule && C._evalUrl(l.src, {
                    nonce: l.nonce || l.getAttribute("nonce")
                }, u) : _(l.textContent.replace(Ae, ""), l, u))
        }
        return n
    }

    function qe(e, t, n) {
        for (var i, r = t ? C.filter(t, e) : e, o = 0; null != (i = r[o]); o++) n || 1 !== i.nodeType || C.cleanData(ge(i)), i.parentNode && (n && re(i) && ve(ge(i, "script")), i.parentNode.removeChild(i));
        return e
    }
    C.extend({
        htmlPrefilter: function(e) {
            return e
        },
        clone: function(e, t, n) {
            var i, r, o, s, a, l, u, c = e.cloneNode(!0),
                f = re(e);
            if (!(v.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || C.isXMLDoc(e)))
                for (s = ge(c), i = 0, r = (o = ge(e)).length; i < r; i++) a = o[i], "input" === (u = (l = s[i]).nodeName.toLowerCase()) && de.test(a.type) ? l.checked = a.checked : "input" !== u && "textarea" !== u || (l.defaultValue = a.defaultValue);
            if (t)
                if (n)
                    for (o = o || ge(e), s = s || ge(c), i = 0, r = o.length; i < r; i++) Ie(o[i], s[i]);
                else Ie(e, c);
            return 0 < (s = ge(c, "script")).length && ve(s, !f && ge(e, "script")), c
        },
        cleanData: function(e) {
            for (var t, n, i, r = C.event.special, o = 0; void 0 !== (n = e[o]); o++)
                if (V(n)) {
                    if (t = n[Y.expando]) {
                        if (t.events)
                            for (i in t.events) r[i] ? C.event.remove(n, i) : C.removeEvent(n, i, t.handle);
                        n[Y.expando] = void 0
                    }
                    n[K.expando] && (n[K.expando] = void 0)
                }
        }
    }), C.fn.extend({
        detach: function(e) {
            return qe(this, e, !0)
        },
        remove: function(e) {
            return qe(this, e)
        },
        text: function(e) {
            return W(this, function(e) {
                return void 0 === e ? C.text(this) : this.empty().each(function() {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                })
            }, null, e, arguments.length)
        },
        append: function() {
            return Pe(this, arguments, function(e) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Oe(this, e).appendChild(e)
            })
        },
        prepend: function() {
            return Pe(this, arguments, function(e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = Oe(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        },
        before: function() {
            return Pe(this, arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function() {
            return Pe(this, arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (C.cleanData(ge(e, !1)), e.textContent = "");
            return this
        },
        clone: function(e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map(function() {
                return C.clone(this, e, t)
            })
        },
        html: function(e) {
            return W(this, function(e) {
                var t = this[0] || {},
                    n = 0,
                    i = this.length;
                if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
                if ("string" == typeof e && !Ne.test(e) && !me[(he.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = C.htmlPrefilter(e);
                    try {
                        for (; n < i; n++) 1 === (t = this[n] || {}).nodeType && (C.cleanData(ge(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (e) {}
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function() {
            var n = [];
            return Pe(this, arguments, function(e) {
                var t = this.parentNode;
                C.inArray(this, n) < 0 && (C.cleanData(ge(this)), t && t.replaceChild(e, this))
            }, n)
        }
    }), C.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(e, s) {
        C.fn[e] = function(e) {
            for (var t, n = [], i = C(e), r = i.length - 1, o = 0; o <= r; o++) t = o === r ? this : this.clone(!0), C(i[o])[s](t), l.apply(n, t.get());
            return this.pushStack(n)
        }
    });
    var He = new RegExp("^(" + ee + ")(?!px)[a-z%]+$", "i"),
        Re = function(e) {
            var t = e.ownerDocument.defaultView;
            return t && t.opener || (t = x), t.getComputedStyle(e)
        },
        Fe = function(e, t, n) {
            var i, r, o = {};
            for (r in t) o[r] = e.style[r], e.style[r] = t[r];
            for (r in i = n.call(e), t) e.style[r] = o[r];
            return i
        },
        Me = new RegExp(ne.join("|"), "i");

    function Be(e, t, n) {
        var i, r, o, s, a = e.style;
        return (n = n || Re(e)) && ("" !== (s = n.getPropertyValue(t) || n[t]) || re(e) || (s = C.style(e, t)), !v.pixelBoxStyles() && He.test(s) && Me.test(t) && (i = a.width, r = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = s, s = n.width, a.width = i, a.minWidth = r, a.maxWidth = o)), void 0 !== s ? s + "" : s
    }

    function We(e, t) {
        return {
            get: function() {
                if (!e()) return (this.get = t).apply(this, arguments);
                delete this.get
            }
        }
    }! function() {
        function e() {
            if (u) {
                l.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", u.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", ie.appendChild(l).appendChild(u);
                var e = x.getComputedStyle(u);
                n = "1%" !== e.top, a = 12 === t(e.marginLeft), u.style.right = "60%", o = 36 === t(e.right), i = 36 === t(e.width), u.style.position = "absolute", r = 12 === t(u.offsetWidth / 3), ie.removeChild(l), u = null
            }
        }

        function t(e) {
            return Math.round(parseFloat(e))
        }
        var n, i, r, o, s, a, l = T.createElement("div"),
            u = T.createElement("div");
        u.style && (u.style.backgroundClip = "content-box", u.cloneNode(!0).style.backgroundClip = "", v.clearCloneStyle = "content-box" === u.style.backgroundClip, C.extend(v, {
            boxSizingReliable: function() {
                return e(), i
            },
            pixelBoxStyles: function() {
                return e(), o
            },
            pixelPosition: function() {
                return e(), n
            },
            reliableMarginLeft: function() {
                return e(), a
            },
            scrollboxSize: function() {
                return e(), r
            },
            reliableTrDimensions: function() {
                var e, t, n, i;
                return null == s && (e = T.createElement("table"), t = T.createElement("tr"), n = T.createElement("div"), e.style.cssText = "position:absolute;left:-11111px", t.style.height = "1px", n.style.height = "9px", ie.appendChild(e).appendChild(t).appendChild(n), i = x.getComputedStyle(t), s = 3 < parseInt(i.height), ie.removeChild(e)), s
            }
        }))
    }();
    var Ue = ["Webkit", "Moz", "ms"],
        Qe = T.createElement("div").style,
        $e = {};

    function ze(e) {
        return C.cssProps[e] || $e[e] || (e in Qe ? e : $e[e] = function(e) {
            for (var t = e[0].toUpperCase() + e.slice(1), n = Ue.length; n--;)
                if ((e = Ue[n] + t) in Qe) return e
        }(e) || e)
    }
    var Ve = /^(none|table(?!-c[ea]).+)/,
        Xe = /^--/,
        Ye = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Ke = {
            letterSpacing: "0",
            fontWeight: "400"
        };

    function Ge(e, t, n) {
        var i = te.exec(t);
        return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t
    }

    function Je(e, t, n, i, r, o) {
        var s = "width" === t ? 1 : 0,
            a = 0,
            l = 0;
        if (n === (i ? "border" : "content")) return 0;
        for (; s < 4; s += 2) "margin" === n && (l += C.css(e, n + ne[s], !0, r)), i ? ("content" === n && (l -= C.css(e, "padding" + ne[s], !0, r)), "margin" !== n && (l -= C.css(e, "border" + ne[s] + "Width", !0, r))) : (l += C.css(e, "padding" + ne[s], !0, r), "padding" !== n ? l += C.css(e, "border" + ne[s] + "Width", !0, r) : a += C.css(e, "border" + ne[s] + "Width", !0, r));
        return !i && 0 <= o && (l += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - o - l - a - .5)) || 0), l
    }

    function Ze(e, t, n) {
        var i = Re(e),
            r = (!v.boxSizingReliable() || n) && "border-box" === C.css(e, "boxSizing", !1, i),
            o = r,
            s = Be(e, t, i),
            a = "offset" + t[0].toUpperCase() + t.slice(1);
        if (He.test(s)) {
            if (!n) return s;
            s = "auto"
        }
        return (!v.boxSizingReliable() && r || !v.reliableTrDimensions() && D(e, "tr") || "auto" === s || !parseFloat(s) && "inline" === C.css(e, "display", !1, i)) && e.getClientRects().length && (r = "border-box" === C.css(e, "boxSizing", !1, i), (o = a in e) && (s = e[a])), (s = parseFloat(s) || 0) + Je(e, t, n || (r ? "border" : "content"), o, i, s) + "px"
    }

    function et(e, t, n, i, r) {
        return new et.prototype.init(e, t, n, i, r)
    }
    C.extend({
        cssHooks: {
            opacity: {
                get: function(e, t) {
                    if (t) {
                        var n = Be(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            gridArea: !0,
            gridColumn: !0,
            gridColumnEnd: !0,
            gridColumnStart: !0,
            gridRow: !0,
            gridRowEnd: !0,
            gridRowStart: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function(e, t, n, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var r, o, s, a = z(t),
                    l = Xe.test(t),
                    u = e.style;
                if (l || (t = ze(a)), s = C.cssHooks[t] || C.cssHooks[a], void 0 === n) return s && "get" in s && void 0 !== (r = s.get(e, !1, i)) ? r : u[t];
                "string" == (o = typeof n) && (r = te.exec(n)) && r[1] && (n = ae(e, t, r), o = "number"), null != n && n == n && ("number" !== o || l || (n += r && r[3] || (C.cssNumber[a] ? "" : "px")), v.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (u[t] = "inherit"), s && "set" in s && void 0 === (n = s.set(e, n, i)) || (l ? u.setProperty(t, n) : u[t] = n))
            }
        },
        css: function(e, t, n, i) {
            var r, o, s, a = z(t);
            return Xe.test(t) || (t = ze(a)), (s = C.cssHooks[t] || C.cssHooks[a]) && "get" in s && (r = s.get(e, !0, n)), void 0 === r && (r = Be(e, t, i)), "normal" === r && t in Ke && (r = Ke[t]), "" === n || n ? (o = parseFloat(r), !0 === n || isFinite(o) ? o || 0 : r) : r
        }
    }), C.each(["height", "width"], function(e, l) {
        C.cssHooks[l] = {
            get: function(e, t, n) {
                if (t) return !Ve.test(C.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? Ze(e, l, n) : Fe(e, Ye, function() {
                    return Ze(e, l, n)
                })
            },
            set: function(e, t, n) {
                var i, r = Re(e),
                    o = !v.scrollboxSize() && "absolute" === r.position,
                    s = (o || n) && "border-box" === C.css(e, "boxSizing", !1, r),
                    a = n ? Je(e, l, n, s, r) : 0;
                return s && o && (a -= Math.ceil(e["offset" + l[0].toUpperCase() + l.slice(1)] - parseFloat(r[l]) - Je(e, l, "border", !1, r) - .5)), a && (i = te.exec(t)) && "px" !== (i[3] || "px") && (e.style[l] = t, t = C.css(e, l)), Ge(0, t, a)
            }
        }
    }), C.cssHooks.marginLeft = We(v.reliableMarginLeft, function(e, t) {
        if (t) return (parseFloat(Be(e, "marginLeft")) || e.getBoundingClientRect().left - Fe(e, {
            marginLeft: 0
        }, function() {
            return e.getBoundingClientRect().left
        })) + "px"
    }), C.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(r, o) {
        C.cssHooks[r + o] = {
            expand: function(e) {
                for (var t = 0, n = {}, i = "string" == typeof e ? e.split(" ") : [e]; t < 4; t++) n[r + ne[t] + o] = i[t] || i[t - 2] || i[0];
                return n
            }
        }, "margin" !== r && (C.cssHooks[r + o].set = Ge)
    }), C.fn.extend({
        css: function(e, t) {
            return W(this, function(e, t, n) {
                var i, r, o = {},
                    s = 0;
                if (Array.isArray(t)) {
                    for (i = Re(e), r = t.length; s < r; s++) o[t[s]] = C.css(e, t[s], !1, i);
                    return o
                }
                return void 0 !== n ? C.style(e, t, n) : C.css(e, t)
            }, e, t, 1 < arguments.length)
        }
    }), ((C.Tween = et).prototype = {
        constructor: et,
        init: function(e, t, n, i, r, o) {
            this.elem = e, this.prop = n, this.easing = r || C.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = o || (C.cssNumber[n] ? "" : "px")
        },
        cur: function() {
            var e = et.propHooks[this.prop];
            return e && e.get ? e.get(this) : et.propHooks._default.get(this)
        },
        run: function(e) {
            var t, n = et.propHooks[this.prop];
            return this.options.duration ? this.pos = t = C.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : et.propHooks._default.set(this), this
        }
    }).init.prototype = et.prototype, (et.propHooks = {
        _default: {
            get: function(e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = C.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0
            },
            set: function(e) {
                C.fx.step[e.prop] ? C.fx.step[e.prop](e) : 1 !== e.elem.nodeType || !C.cssHooks[e.prop] && null == e.elem.style[ze(e.prop)] ? e.elem[e.prop] = e.now : C.style(e.elem, e.prop, e.now + e.unit)
            }
        }
    }).scrollTop = et.propHooks.scrollLeft = {
        set: function(e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, C.easing = {
        linear: function(e) {
            return e
        },
        swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2
        },
        _default: "swing"
    }, C.fx = et.prototype.init, C.fx.step = {};
    var tt, nt, it, rt, ot = /^(?:toggle|show|hide)$/,
        st = /queueHooks$/;

    function at() {
        nt && (!1 === T.hidden && x.requestAnimationFrame ? x.requestAnimationFrame(at) : x.setTimeout(at, C.fx.interval), C.fx.tick())
    }

    function lt() {
        return x.setTimeout(function() {
            tt = void 0
        }), tt = Date.now()
    }

    function ut(e, t) {
        var n, i = 0,
            r = {
                height: e
            };
        for (t = t ? 1 : 0; i < 4; i += 2 - t) r["margin" + (n = ne[i])] = r["padding" + n] = e;
        return t && (r.opacity = r.width = e), r
    }

    function ct(e, t, n) {
        for (var i, r = (ft.tweeners[t] || []).concat(ft.tweeners["*"]), o = 0, s = r.length; o < s; o++)
            if (i = r[o].call(n, t, e)) return i
    }

    function ft(o, e, t) {
        var n, s, i = 0,
            r = ft.prefilters.length,
            a = C.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (s) return !1;
                for (var e = tt || lt(), t = Math.max(0, u.startTime + u.duration - e), n = 1 - (t / u.duration || 0), i = 0, r = u.tweens.length; i < r; i++) u.tweens[i].run(n);
                return a.notifyWith(o, [u, n, t]), n < 1 && r ? t : (r || a.notifyWith(o, [u, 1, 0]), a.resolveWith(o, [u]), !1)
            },
            u = a.promise({
                elem: o,
                props: C.extend({}, e),
                opts: C.extend(!0, {
                    specialEasing: {},
                    easing: C.easing._default
                }, t),
                originalProperties: e,
                originalOptions: t,
                startTime: tt || lt(),
                duration: t.duration,
                tweens: [],
                createTween: function(e, t) {
                    var n = C.Tween(o, u.opts, e, t, u.opts.specialEasing[e] || u.opts.easing);
                    return u.tweens.push(n), n
                },
                stop: function(e) {
                    var t = 0,
                        n = e ? u.tweens.length : 0;
                    if (s) return this;
                    for (s = !0; t < n; t++) u.tweens[t].run(1);
                    return e ? (a.notifyWith(o, [u, 1, 0]), a.resolveWith(o, [u, e])) : a.rejectWith(o, [u, e]), this
                }
            }),
            c = u.props;
        for (function(e, t) {
                var n, i, r, o, s;
                for (n in e)
                    if (r = t[i = z(n)], o = e[n], Array.isArray(o) && (r = o[1], o = e[n] = o[0]), n !== i && (e[i] = o, delete e[n]), (s = C.cssHooks[i]) && "expand" in s)
                        for (n in o = s.expand(o), delete e[i], o) n in e || (e[n] = o[n], t[n] = r);
                    else t[i] = r
            }(c, u.opts.specialEasing); i < r; i++)
            if (n = ft.prefilters[i].call(u, o, c, u.opts)) return y(n.stop) && (C._queueHooks(u.elem, u.opts.queue).stop = n.stop.bind(n)), n;
        return C.map(c, ct, u), y(u.opts.start) && u.opts.start.call(o, u), u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always), C.fx.timer(C.extend(l, {
            elem: o,
            anim: u,
            queue: u.opts.queue
        })), u
    }
    C.Animation = C.extend(ft, {
        tweeners: {
            "*": [function(e, t) {
                var n = this.createTween(e, t);
                return ae(n.elem, e, te.exec(t), n), n
            }]
        },
        tweener: function(e, t) {
            for (var n, i = 0, r = (e = y(e) ? (t = e, ["*"]) : e.match(P)).length; i < r; i++) n = e[i], ft.tweeners[n] = ft.tweeners[n] || [], ft.tweeners[n].unshift(t)
        },
        prefilters: [function(e, t, n) {
            var i, r, o, s, a, l, u, c, f = "width" in t || "height" in t,
                d = this,
                h = {},
                p = e.style,
                m = e.nodeType && se(e),
                g = Y.get(e, "fxshow");
            for (i in n.queue || (null == (s = C._queueHooks(e, "fx")).unqueued && (s.unqueued = 0, a = s.empty.fire, s.empty.fire = function() {
                    s.unqueued || a()
                }), s.unqueued++, d.always(function() {
                    d.always(function() {
                        s.unqueued--, C.queue(e, "fx").length || s.empty.fire()
                    })
                })), t)
                if (r = t[i], ot.test(r)) {
                    if (delete t[i], o = o || "toggle" === r, r === (m ? "hide" : "show")) {
                        if ("show" !== r || !g || void 0 === g[i]) continue;
                        m = !0
                    }
                    h[i] = g && g[i] || C.style(e, i)
                } if ((l = !C.isEmptyObject(t)) || !C.isEmptyObject(h))
                for (i in f && 1 === e.nodeType && (n.overflow = [p.overflow, p.overflowX, p.overflowY], null == (u = g && g.display) && (u = Y.get(e, "display")), "none" === (c = C.css(e, "display")) && (u ? c = u : (ue([e], !0), u = e.style.display || u, c = C.css(e, "display"), ue([e]))), ("inline" === c || "inline-block" === c && null != u) && "none" === C.css(e, "float") && (l || (d.done(function() {
                        p.display = u
                    }), null == u && (c = p.display, u = "none" === c ? "" : c)), p.display = "inline-block")), n.overflow && (p.overflow = "hidden", d.always(function() {
                        p.overflow = n.overflow[0], p.overflowX = n.overflow[1], p.overflowY = n.overflow[2]
                    })), l = !1, h) l || (g ? "hidden" in g && (m = g.hidden) : g = Y.access(e, "fxshow", {
                    display: u
                }), o && (g.hidden = !m), m && ue([e], !0), d.done(function() {
                    for (i in m || ue([e]), Y.remove(e, "fxshow"), h) C.style(e, i, h[i])
                })), l = ct(m ? g[i] : 0, i, d), i in g || (g[i] = l.start, m && (l.end = l.start, l.start = 0))
        }],
        prefilter: function(e, t) {
            t ? ft.prefilters.unshift(e) : ft.prefilters.push(e)
        }
    }), C.speed = function(e, t, n) {
        var i = e && "object" == typeof e ? C.extend({}, e) : {
            complete: n || !n && t || y(e) && e,
            duration: e,
            easing: n && t || t && !y(t) && t
        };
        return C.fx.off ? i.duration = 0 : "number" != typeof i.duration && (i.duration in C.fx.speeds ? i.duration = C.fx.speeds[i.duration] : i.duration = C.fx.speeds._default), null != i.queue && !0 !== i.queue || (i.queue = "fx"), i.old = i.complete, i.complete = function() {
            y(i.old) && i.old.call(this), i.queue && C.dequeue(this, i.queue)
        }, i
    }, C.fn.extend({
        fadeTo: function(e, t, n, i) {
            return this.filter(se).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, n, i)
        },
        animate: function(t, e, n, i) {
            var r = C.isEmptyObject(t),
                o = C.speed(e, n, i),
                s = function() {
                    var e = ft(this, C.extend({}, t), o);
                    (r || Y.get(this, "finish")) && e.stop(!0)
                };
            return s.finish = s, r || !1 === o.queue ? this.each(s) : this.queue(o.queue, s)
        },
        stop: function(r, e, o) {
            var s = function(e) {
                var t = e.stop;
                delete e.stop, t(o)
            };
            return "string" != typeof r && (o = e, e = r, r = void 0), e && this.queue(r || "fx", []), this.each(function() {
                var e = !0,
                    t = null != r && r + "queueHooks",
                    n = C.timers,
                    i = Y.get(this);
                if (t) i[t] && i[t].stop && s(i[t]);
                else
                    for (t in i) i[t] && i[t].stop && st.test(t) && s(i[t]);
                for (t = n.length; t--;) n[t].elem !== this || null != r && n[t].queue !== r || (n[t].anim.stop(o), e = !1, n.splice(t, 1));
                !e && o || C.dequeue(this, r)
            })
        },
        finish: function(s) {
            return !1 !== s && (s = s || "fx"), this.each(function() {
                var e, t = Y.get(this),
                    n = t[s + "queue"],
                    i = t[s + "queueHooks"],
                    r = C.timers,
                    o = n ? n.length : 0;
                for (t.finish = !0, C.queue(this, s, []), i && i.stop && i.stop.call(this, !0), e = r.length; e--;) r[e].elem === this && r[e].queue === s && (r[e].anim.stop(!0), r.splice(e, 1));
                for (e = 0; e < o; e++) n[e] && n[e].finish && n[e].finish.call(this);
                delete t.finish
            })
        }
    }), C.each(["toggle", "show", "hide"], function(e, i) {
        var r = C.fn[i];
        C.fn[i] = function(e, t, n) {
            return null == e || "boolean" == typeof e ? r.apply(this, arguments) : this.animate(ut(i, !0), e, t, n)
        }
    }), C.each({
        slideDown: ut("show"),
        slideUp: ut("hide"),
        slideToggle: ut("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function(e, i) {
        C.fn[e] = function(e, t, n) {
            return this.animate(i, e, t, n)
        }
    }), C.timers = [], C.fx.tick = function() {
        var e, t = 0,
            n = C.timers;
        for (tt = Date.now(); t < n.length; t++)(e = n[t])() || n[t] !== e || n.splice(t--, 1);
        n.length || C.fx.stop(), tt = void 0
    }, C.fx.timer = function(e) {
        C.timers.push(e), C.fx.start()
    }, C.fx.interval = 13, C.fx.start = function() {
        nt || (nt = !0, at())
    }, C.fx.stop = function() {
        nt = null
    }, C.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, C.fn.delay = function(i, e) {
        return i = C.fx && C.fx.speeds[i] || i, e = e || "fx", this.queue(e, function(e, t) {
            var n = x.setTimeout(e, i);
            t.stop = function() {
                x.clearTimeout(n)
            }
        })
    }, it = T.createElement("input"), rt = T.createElement("select").appendChild(T.createElement("option")), it.type = "checkbox", v.checkOn = "" !== it.value, v.optSelected = rt.selected, (it = T.createElement("input")).value = "t", it.type = "radio", v.radioValue = "t" === it.value;
    var dt, ht = C.expr.attrHandle;
    C.fn.extend({
        attr: function(e, t) {
            return W(this, C.attr, e, t, 1 < arguments.length)
        },
        removeAttr: function(e) {
            return this.each(function() {
                C.removeAttr(this, e)
            })
        }
    }), C.extend({
        attr: function(e, t, n) {
            var i, r, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return void 0 === e.getAttribute ? C.prop(e, t, n) : (1 === o && C.isXMLDoc(e) || (r = C.attrHooks[t.toLowerCase()] || (C.expr.match.bool.test(t) ? dt : void 0)), void 0 !== n ? null === n ? void C.removeAttr(e, t) : r && "set" in r && void 0 !== (i = r.set(e, n, t)) ? i : (e.setAttribute(t, n + ""), n) : r && "get" in r && null !== (i = r.get(e, t)) ? i : null == (i = C.find.attr(e, t)) ? void 0 : i)
        },
        attrHooks: {
            type: {
                set: function(e, t) {
                    if (!v.radioValue && "radio" === t && D(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        },
        removeAttr: function(e, t) {
            var n, i = 0,
                r = t && t.match(P);
            if (r && 1 === e.nodeType)
                for (; n = r[i++];) e.removeAttribute(n)
        }
    }), dt = {
        set: function(e, t, n) {
            return !1 === t ? C.removeAttr(e, n) : e.setAttribute(n, n), n
        }
    }, C.each(C.expr.match.bool.source.match(/\w+/g), function(e, t) {
        var s = ht[t] || C.find.attr;
        ht[t] = function(e, t, n) {
            var i, r, o = t.toLowerCase();
            return n || (r = ht[o], ht[o] = i, i = null != s(e, t, n) ? o : null, ht[o] = r), i
        }
    });
    var pt = /^(?:input|select|textarea|button)$/i,
        mt = /^(?:a|area)$/i;

    function gt(e) {
        return (e.match(P) || []).join(" ")
    }

    function vt(e) {
        return e.getAttribute && e.getAttribute("class") || ""
    }

    function yt(e) {
        return Array.isArray(e) ? e : "string" == typeof e && e.match(P) || []
    }
    C.fn.extend({
        prop: function(e, t) {
            return W(this, C.prop, e, t, 1 < arguments.length)
        },
        removeProp: function(e) {
            return this.each(function() {
                delete this[C.propFix[e] || e]
            })
        }
    }), C.extend({
        prop: function(e, t, n) {
            var i, r, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return 1 === o && C.isXMLDoc(e) || (t = C.propFix[t] || t, r = C.propHooks[t]), void 0 !== n ? r && "set" in r && void 0 !== (i = r.set(e, n, t)) ? i : e[t] = n : r && "get" in r && null !== (i = r.get(e, t)) ? i : e[t]
        },
        propHooks: {
            tabIndex: {
                get: function(e) {
                    var t = C.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : pt.test(e.nodeName) || mt.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        },
        propFix: {
            for: "htmlFor",
            class: "className"
        }
    }), v.optSelected || (C.propHooks.selected = {
        get: function(e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        },
        set: function(e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    }), C.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        C.propFix[this.toLowerCase()] = this
    }), C.fn.extend({
        addClass: function(t) {
            var e, n, i, r, o, s, a, l = 0;
            if (y(t)) return this.each(function(e) {
                C(this).addClass(t.call(this, e, vt(this)))
            });
            if ((e = yt(t)).length)
                for (; n = this[l++];)
                    if (r = vt(n), i = 1 === n.nodeType && " " + gt(r) + " ") {
                        for (s = 0; o = e[s++];) i.indexOf(" " + o + " ") < 0 && (i += o + " ");
                        r !== (a = gt(i)) && n.setAttribute("class", a)
                    } return this
        },
        removeClass: function(t) {
            var e, n, i, r, o, s, a, l = 0;
            if (y(t)) return this.each(function(e) {
                C(this).removeClass(t.call(this, e, vt(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ((e = yt(t)).length)
                for (; n = this[l++];)
                    if (r = vt(n), i = 1 === n.nodeType && " " + gt(r) + " ") {
                        for (s = 0; o = e[s++];)
                            for (; - 1 < i.indexOf(" " + o + " ");) i = i.replace(" " + o + " ", " ");
                        r !== (a = gt(i)) && n.setAttribute("class", a)
                    } return this
        },
        toggleClass: function(r, t) {
            var o = typeof r,
                s = "string" === o || Array.isArray(r);
            return "boolean" == typeof t && s ? t ? this.addClass(r) : this.removeClass(r) : y(r) ? this.each(function(e) {
                C(this).toggleClass(r.call(this, e, vt(this), t), t)
            }) : this.each(function() {
                var e, t, n, i;
                if (s)
                    for (t = 0, n = C(this), i = yt(r); e = i[t++];) n.hasClass(e) ? n.removeClass(e) : n.addClass(e);
                else void 0 !== r && "boolean" !== o || ((e = vt(this)) && Y.set(this, "__className__", e), this.setAttribute && this.setAttribute("class", e || !1 === r ? "" : Y.get(this, "__className__") || ""))
            })
        },
        hasClass: function(e) {
            var t, n, i = 0;
            for (t = " " + e + " "; n = this[i++];)
                if (1 === n.nodeType && -1 < (" " + gt(vt(n)) + " ").indexOf(t)) return !0;
            return !1
        }
    });
    var bt = /\r/g;
    C.fn.extend({
        val: function(n) {
            var i, e, r, t = this[0];
            return arguments.length ? (r = y(n), this.each(function(e) {
                var t;
                1 === this.nodeType && (null == (t = r ? n.call(this, e, C(this).val()) : n) ? t = "" : "number" == typeof t ? t += "" : Array.isArray(t) && (t = C.map(t, function(e) {
                    return null == e ? "" : e + ""
                })), (i = C.valHooks[this.type] || C.valHooks[this.nodeName.toLowerCase()]) && "set" in i && void 0 !== i.set(this, t, "value") || (this.value = t))
            })) : t ? (i = C.valHooks[t.type] || C.valHooks[t.nodeName.toLowerCase()]) && "get" in i && void 0 !== (e = i.get(t, "value")) ? e : "string" == typeof(e = t.value) ? e.replace(bt, "") : null == e ? "" : e : void 0
        }
    }), C.extend({
        valHooks: {
            option: {
                get: function(e) {
                    var t = C.find.attr(e, "value");
                    return null != t ? t : gt(C.text(e))
                }
            },
            select: {
                get: function(e) {
                    var t, n, i, r = e.options,
                        o = e.selectedIndex,
                        s = "select-one" === e.type,
                        a = s ? null : [],
                        l = s ? o + 1 : r.length;
                    for (i = o < 0 ? l : s ? o : 0; i < l; i++)
                        if (((n = r[i]).selected || i === o) && !n.disabled && (!n.parentNode.disabled || !D(n.parentNode, "optgroup"))) {
                            if (t = C(n).val(), s) return t;
                            a.push(t)
                        } return a
                },
                set: function(e, t) {
                    for (var n, i, r = e.options, o = C.makeArray(t), s = r.length; s--;)((i = r[s]).selected = -1 < C.inArray(C.valHooks.option.get(i), o)) && (n = !0);
                    return n || (e.selectedIndex = -1), o
                }
            }
        }
    }), C.each(["radio", "checkbox"], function() {
        C.valHooks[this] = {
            set: function(e, t) {
                if (Array.isArray(t)) return e.checked = -1 < C.inArray(C(e).val(), t)
            }
        }, v.checkOn || (C.valHooks[this].get = function(e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    }), v.focusin = "onfocusin" in x;
    var _t = /^(?:focusinfocus|focusoutblur)$/,
        wt = function(e) {
            e.stopPropagation()
        };
    C.extend(C.event, {
        trigger: function(e, t, n, i) {
            var r, o, s, a, l, u, c, f, d = [n || T],
                h = g.call(e, "type") ? e.type : e,
                p = g.call(e, "namespace") ? e.namespace.split(".") : [];
            if (o = f = s = n = n || T, 3 !== n.nodeType && 8 !== n.nodeType && !_t.test(h + C.event.triggered) && (-1 < h.indexOf(".") && (h = (p = h.split(".")).shift(), p.sort()), l = h.indexOf(":") < 0 && "on" + h, (e = e[C.expando] ? e : new C.Event(h, "object" == typeof e && e)).isTrigger = i ? 2 : 3, e.namespace = p.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = n), t = null == t ? [e] : C.makeArray(t, [e]), c = C.event.special[h] || {}, i || !c.trigger || !1 !== c.trigger.apply(n, t))) {
                if (!i && !c.noBubble && !b(n)) {
                    for (a = c.delegateType || h, _t.test(a + h) || (o = o.parentNode); o; o = o.parentNode) d.push(o), s = o;
                    s === (n.ownerDocument || T) && d.push(s.defaultView || s.parentWindow || x)
                }
                for (r = 0;
                    (o = d[r++]) && !e.isPropagationStopped();) f = o, e.type = 1 < r ? a : c.bindType || h, (u = (Y.get(o, "events") || Object.create(null))[e.type] && Y.get(o, "handle")) && u.apply(o, t), (u = l && o[l]) && u.apply && V(o) && (e.result = u.apply(o, t), !1 === e.result && e.preventDefault());
                return e.type = h, i || e.isDefaultPrevented() || c._default && !1 !== c._default.apply(d.pop(), t) || !V(n) || l && y(n[h]) && !b(n) && ((s = n[l]) && (n[l] = null), C.event.triggered = h, e.isPropagationStopped() && f.addEventListener(h, wt), n[h](), e.isPropagationStopped() && f.removeEventListener(h, wt), C.event.triggered = void 0, s && (n[l] = s)), e.result
            }
        },
        simulate: function(e, t, n) {
            var i = C.extend(new C.Event, n, {
                type: e,
                isSimulated: !0
            });
            C.event.trigger(i, null, t)
        }
    }), C.fn.extend({
        trigger: function(e, t) {
            return this.each(function() {
                C.event.trigger(e, t, this)
            })
        },
        triggerHandler: function(e, t) {
            var n = this[0];
            if (n) return C.event.trigger(e, t, n, !0)
        }
    }), v.focusin || C.each({
        focus: "focusin",
        blur: "focusout"
    }, function(n, i) {
        var r = function(e) {
            C.event.simulate(i, e.target, C.event.fix(e))
        };
        C.event.special[i] = {
            setup: function() {
                var e = this.ownerDocument || this.document || this,
                    t = Y.access(e, i);
                t || e.addEventListener(n, r, !0), Y.access(e, i, (t || 0) + 1)
            },
            teardown: function() {
                var e = this.ownerDocument || this.document || this,
                    t = Y.access(e, i) - 1;
                t ? Y.access(e, i, t) : (e.removeEventListener(n, r, !0), Y.remove(e, i))
            }
        }
    });
    var Et = x.location,
        xt = {
            guid: Date.now()
        },
        Tt = /\?/;
    C.parseXML = function(e) {
        var t;
        if (!e || "string" != typeof e) return null;
        try {
            t = (new x.DOMParser).parseFromString(e, "text/xml")
        } catch (e) {
            t = void 0
        }
        return t && !t.getElementsByTagName("parsererror").length || C.error("Invalid XML: " + e), t
    };
    var Ct = /\[\]$/,
        St = /\r?\n/g,
        Dt = /^(?:submit|button|image|reset|file)$/i,
        Nt = /^(?:input|select|textarea|keygen)/i;

    function kt(n, e, i, r) {
        var t;
        if (Array.isArray(e)) C.each(e, function(e, t) {
            i || Ct.test(n) ? r(n, t) : kt(n + "[" + ("object" == typeof t && null != t ? e : "") + "]", t, i, r)
        });
        else if (i || "object" !== w(e)) r(n, e);
        else
            for (t in e) kt(n + "[" + t + "]", e[t], i, r)
    }
    C.param = function(e, t) {
        var n, i = [],
            r = function(e, t) {
                var n = y(t) ? t() : t;
                i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
            };
        if (null == e) return "";
        if (Array.isArray(e) || e.jquery && !C.isPlainObject(e)) C.each(e, function() {
            r(this.name, this.value)
        });
        else
            for (n in e) kt(n, e[n], t, r);
        return i.join("&")
    }, C.fn.extend({
        serialize: function() {
            return C.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var e = C.prop(this, "elements");
                return e ? C.makeArray(e) : this
            }).filter(function() {
                var e = this.type;
                return this.name && !C(this).is(":disabled") && Nt.test(this.nodeName) && !Dt.test(e) && (this.checked || !de.test(e))
            }).map(function(e, t) {
                var n = C(this).val();
                return null == n ? null : Array.isArray(n) ? C.map(n, function(e) {
                    return {
                        name: t.name,
                        value: e.replace(St, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: n.replace(St, "\r\n")
                }
            }).get()
        }
    });
    var At = /%20/g,
        Ot = /#.*$/,
        jt = /([?&])_=[^&]*/,
        Lt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        It = /^(?:GET|HEAD)$/,
        Pt = /^\/\//,
        qt = {},
        Ht = {},
        Rt = "*/".concat("*"),
        Ft = T.createElement("a");

    function Mt(o) {
        return function(e, t) {
            "string" != typeof e && (t = e, e = "*");
            var n, i = 0,
                r = e.toLowerCase().match(P) || [];
            if (y(t))
                for (; n = r[i++];) "+" === n[0] ? (n = n.slice(1) || "*", (o[n] = o[n] || []).unshift(t)) : (o[n] = o[n] || []).push(t)
        }
    }

    function Bt(t, r, o, s) {
        var a = {},
            l = t === Ht;

        function u(e) {
            var i;
            return a[e] = !0, C.each(t[e] || [], function(e, t) {
                var n = t(r, o, s);
                return "string" != typeof n || l || a[n] ? l ? !(i = n) : void 0 : (r.dataTypes.unshift(n), u(n), !1)
            }), i
        }
        return u(r.dataTypes[0]) || !a["*"] && u("*")
    }

    function Wt(e, t) {
        var n, i, r = C.ajaxSettings.flatOptions || {};
        for (n in t) void 0 !== t[n] && ((r[n] ? e : i || (i = {}))[n] = t[n]);
        return i && C.extend(!0, e, i), e
    }
    Ft.href = Et.href, C.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Et.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Et.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Rt,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /\bxml\b/,
                html: /\bhtml/,
                json: /\bjson\b/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": JSON.parse,
                "text xml": C.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(e, t) {
            return t ? Wt(Wt(e, C.ajaxSettings), t) : Wt(C.ajaxSettings, e)
        },
        ajaxPrefilter: Mt(qt),
        ajaxTransport: Mt(Ht),
        ajax: function(e, t) {
            "object" == typeof e && (t = e, e = void 0), t = t || {};
            var c, f, d, n, h, i, p, m, r, o, g = C.ajaxSetup({}, t),
                v = g.context || g,
                y = g.context && (v.nodeType || v.jquery) ? C(v) : C.event,
                b = C.Deferred(),
                _ = C.Callbacks("once memory"),
                w = g.statusCode || {},
                s = {},
                a = {},
                l = "canceled",
                E = {
                    readyState: 0,
                    getResponseHeader: function(e) {
                        var t;
                        if (p) {
                            if (!n)
                                for (n = {}; t = Lt.exec(d);) n[t[1].toLowerCase() + " "] = (n[t[1].toLowerCase() + " "] || []).concat(t[2]);
                            t = n[e.toLowerCase() + " "]
                        }
                        return null == t ? null : t.join(", ")
                    },
                    getAllResponseHeaders: function() {
                        return p ? d : null
                    },
                    setRequestHeader: function(e, t) {
                        return null == p && (e = a[e.toLowerCase()] = a[e.toLowerCase()] || e, s[e] = t), this
                    },
                    overrideMimeType: function(e) {
                        return null == p && (g.mimeType = e), this
                    },
                    statusCode: function(e) {
                        var t;
                        if (e)
                            if (p) E.always(e[E.status]);
                            else
                                for (t in e) w[t] = [w[t], e[t]];
                        return this
                    },
                    abort: function(e) {
                        var t = e || l;
                        return c && c.abort(t), u(0, t), this
                    }
                };
            if (b.promise(E), g.url = ((e || g.url || Et.href) + "").replace(Pt, Et.protocol + "//"), g.type = t.method || t.type || g.method || g.type, g.dataTypes = (g.dataType || "*").toLowerCase().match(P) || [""], null == g.crossDomain) {
                i = T.createElement("a");
                try {
                    i.href = g.url, i.href = i.href, g.crossDomain = Ft.protocol + "//" + Ft.host != i.protocol + "//" + i.host
                } catch (e) {
                    g.crossDomain = !0
                }
            }
            if (g.data && g.processData && "string" != typeof g.data && (g.data = C.param(g.data, g.traditional)), Bt(qt, g, t, E), p) return E;
            for (r in (m = C.event && g.global) && 0 == C.active++ && C.event.trigger("ajaxStart"), g.type = g.type.toUpperCase(), g.hasContent = !It.test(g.type), f = g.url.replace(Ot, ""), g.hasContent ? g.data && g.processData && 0 === (g.contentType || "").indexOf("application/x-www-form-urlencoded") && (g.data = g.data.replace(At, "+")) : (o = g.url.slice(f.length), g.data && (g.processData || "string" == typeof g.data) && (f += (Tt.test(f) ? "&" : "?") + g.data, delete g.data), !1 === g.cache && (f = f.replace(jt, "$1"), o = (Tt.test(f) ? "&" : "?") + "_=" + xt.guid++ + o), g.url = f + o), g.ifModified && (C.lastModified[f] && E.setRequestHeader("If-Modified-Since", C.lastModified[f]), C.etag[f] && E.setRequestHeader("If-None-Match", C.etag[f])), (g.data && g.hasContent && !1 !== g.contentType || t.contentType) && E.setRequestHeader("Content-Type", g.contentType), E.setRequestHeader("Accept", g.dataTypes[0] && g.accepts[g.dataTypes[0]] ? g.accepts[g.dataTypes[0]] + ("*" !== g.dataTypes[0] ? ", " + Rt + "; q=0.01" : "") : g.accepts["*"]), g.headers) E.setRequestHeader(r, g.headers[r]);
            if (g.beforeSend && (!1 === g.beforeSend.call(v, E, g) || p)) return E.abort();
            if (l = "abort", _.add(g.complete), E.done(g.success), E.fail(g.error), c = Bt(Ht, g, t, E)) {
                if (E.readyState = 1, m && y.trigger("ajaxSend", [E, g]), p) return E;
                g.async && 0 < g.timeout && (h = x.setTimeout(function() {
                    E.abort("timeout")
                }, g.timeout));
                try {
                    p = !1, c.send(s, u)
                } catch (e) {
                    if (p) throw e;
                    u(-1, e)
                }
            } else u(-1, "No Transport");

            function u(e, t, n, i) {
                var r, o, s, a, l, u = t;
                p || (p = !0, h && x.clearTimeout(h), c = void 0, d = i || "", E.readyState = 0 < e ? 4 : 0, r = 200 <= e && e < 300 || 304 === e, n && (a = function(e, t, n) {
                    for (var i, r, o, s, a = e.contents, l = e.dataTypes;
                        "*" === l[0];) l.shift(), void 0 === i && (i = e.mimeType || t.getResponseHeader("Content-Type"));
                    if (i)
                        for (r in a)
                            if (a[r] && a[r].test(i)) {
                                l.unshift(r);
                                break
                            } if (l[0] in n) o = l[0];
                    else {
                        for (r in n) {
                            if (!l[0] || e.converters[r + " " + l[0]]) {
                                o = r;
                                break
                            }
                            s || (s = r)
                        }
                        o = o || s
                    }
                    if (o) return o !== l[0] && l.unshift(o), n[o]
                }(g, E, n)), !r && -1 < C.inArray("script", g.dataTypes) && (g.converters["text script"] = function() {}), a = function(e, t, n, i) {
                    var r, o, s, a, l, u = {},
                        c = e.dataTypes.slice();
                    if (c[1])
                        for (s in e.converters) u[s.toLowerCase()] = e.converters[s];
                    for (o = c.shift(); o;)
                        if (e.responseFields[o] && (n[e.responseFields[o]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = o, o = c.shift())
                            if ("*" === o) o = l;
                            else if ("*" !== l && l !== o) {
                        if (!(s = u[l + " " + o] || u["* " + o]))
                            for (r in u)
                                if ((a = r.split(" "))[1] === o && (s = u[l + " " + a[0]] || u["* " + a[0]])) {
                                    !0 === s ? s = u[r] : !0 !== u[r] && (o = a[0], c.unshift(a[1]));
                                    break
                                } if (!0 !== s)
                            if (s && e.throws) t = s(t);
                            else try {
                                t = s(t)
                            } catch (e) {
                                return {
                                    state: "parsererror",
                                    error: s ? e : "No conversion from " + l + " to " + o
                                }
                            }
                    }
                    return {
                        state: "success",
                        data: t
                    }
                }(g, a, E, r), r ? (g.ifModified && ((l = E.getResponseHeader("Last-Modified")) && (C.lastModified[f] = l), (l = E.getResponseHeader("etag")) && (C.etag[f] = l)), 204 === e || "HEAD" === g.type ? u = "nocontent" : 304 === e ? u = "notmodified" : (u = a.state, o = a.data, r = !(s = a.error))) : (s = u, !e && u || (u = "error", e < 0 && (e = 0))), E.status = e, E.statusText = (t || u) + "", r ? b.resolveWith(v, [o, u, E]) : b.rejectWith(v, [E, u, s]), E.statusCode(w), w = void 0, m && y.trigger(r ? "ajaxSuccess" : "ajaxError", [E, g, r ? o : s]), _.fireWith(v, [E, u]), m && (y.trigger("ajaxComplete", [E, g]), --C.active || C.event.trigger("ajaxStop")))
            }
            return E
        },
        getJSON: function(e, t, n) {
            return C.get(e, t, n, "json")
        },
        getScript: function(e, t) {
            return C.get(e, void 0, t, "script")
        }
    }), C.each(["get", "post"], function(e, r) {
        C[r] = function(e, t, n, i) {
            return y(t) && (i = i || n, n = t, t = void 0), C.ajax(C.extend({
                url: e,
                type: r,
                dataType: i,
                data: t,
                success: n
            }, C.isPlainObject(e) && e))
        }
    }), C.ajaxPrefilter(function(e) {
        var t;
        for (t in e.headers) "content-type" === t.toLowerCase() && (e.contentType = e.headers[t] || "")
    }), C._evalUrl = function(e, t, n) {
        return C.ajax({
            url: e,
            type: "GET",
            dataType: "script",
            cache: !0,
            async: !1,
            global: !1,
            converters: {
                "text script": function() {}
            },
            dataFilter: function(e) {
                C.globalEval(e, t, n)
            }
        })
    }, C.fn.extend({
        wrapAll: function(e) {
            var t;
            return this[0] && (y(e) && (e = e.call(this[0])), t = C(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function() {
                for (var e = this; e.firstElementChild;) e = e.firstElementChild;
                return e
            }).append(this)), this
        },
        wrapInner: function(n) {
            return y(n) ? this.each(function(e) {
                C(this).wrapInner(n.call(this, e))
            }) : this.each(function() {
                var e = C(this),
                    t = e.contents();
                t.length ? t.wrapAll(n) : e.append(n)
            })
        },
        wrap: function(t) {
            var n = y(t);
            return this.each(function(e) {
                C(this).wrapAll(n ? t.call(this, e) : t)
            })
        },
        unwrap: function(e) {
            return this.parent(e).not("body").each(function() {
                C(this).replaceWith(this.childNodes)
            }), this
        }
    }), C.expr.pseudos.hidden = function(e) {
        return !C.expr.pseudos.visible(e)
    }, C.expr.pseudos.visible = function(e) {
        return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
    }, C.ajaxSettings.xhr = function() {
        try {
            return new x.XMLHttpRequest
        } catch (e) {}
    };
    var Ut = {
            0: 200,
            1223: 204
        },
        Qt = C.ajaxSettings.xhr();
    v.cors = !!Qt && "withCredentials" in Qt, v.ajax = Qt = !!Qt, C.ajaxTransport(function(r) {
        var o, s;
        if (v.cors || Qt && !r.crossDomain) return {
            send: function(e, t) {
                var n, i = r.xhr();
                if (i.open(r.type, r.url, r.async, r.username, r.password), r.xhrFields)
                    for (n in r.xhrFields) i[n] = r.xhrFields[n];
                for (n in r.mimeType && i.overrideMimeType && i.overrideMimeType(r.mimeType), r.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest"), e) i.setRequestHeader(n, e[n]);
                o = function(e) {
                    return function() {
                        o && (o = s = i.onload = i.onerror = i.onabort = i.ontimeout = i.onreadystatechange = null, "abort" === e ? i.abort() : "error" === e ? "number" != typeof i.status ? t(0, "error") : t(i.status, i.statusText) : t(Ut[i.status] || i.status, i.statusText, "text" !== (i.responseType || "text") || "string" != typeof i.responseText ? {
                            binary: i.response
                        } : {
                            text: i.responseText
                        }, i.getAllResponseHeaders()))
                    }
                }, i.onload = o(), s = i.onerror = i.ontimeout = o("error"), void 0 !== i.onabort ? i.onabort = s : i.onreadystatechange = function() {
                    4 === i.readyState && x.setTimeout(function() {
                        o && s()
                    })
                }, o = o("abort");
                try {
                    i.send(r.hasContent && r.data || null)
                } catch (e) {
                    if (o) throw e
                }
            },
            abort: function() {
                o && o()
            }
        }
    }), C.ajaxPrefilter(function(e) {
        e.crossDomain && (e.contents.script = !1)
    }), C.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /\b(?:java|ecma)script\b/
        },
        converters: {
            "text script": function(e) {
                return C.globalEval(e), e
            }
        }
    }), C.ajaxPrefilter("script", function(e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
    }), C.ajaxTransport("script", function(n) {
        var i, r;
        if (n.crossDomain || n.scriptAttrs) return {
            send: function(e, t) {
                i = C("<script>").attr(n.scriptAttrs || {}).prop({
                    charset: n.scriptCharset,
                    src: n.url
                }).on("load error", r = function(e) {
                    i.remove(), r = null, e && t("error" === e.type ? 404 : 200, e.type)
                }), T.head.appendChild(i[0])
            },
            abort: function() {
                r && r()
            }
        }
    });
    var $t, zt = [],
        Vt = /(=)\?(?=&|$)|\?\?/;
    C.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = zt.pop() || C.expando + "_" + xt.guid++;
            return this[e] = !0, e
        }
    }), C.ajaxPrefilter("json jsonp", function(e, t, n) {
        var i, r, o, s = !1 !== e.jsonp && (Vt.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && Vt.test(e.data) && "data");
        if (s || "jsonp" === e.dataTypes[0]) return i = e.jsonpCallback = y(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, s ? e[s] = e[s].replace(Vt, "$1" + i) : !1 !== e.jsonp && (e.url += (Tt.test(e.url) ? "&" : "?") + e.jsonp + "=" + i), e.converters["script json"] = function() {
            return o || C.error(i + " was not called"), o[0]
        }, e.dataTypes[0] = "json", r = x[i], x[i] = function() {
            o = arguments
        }, n.always(function() {
            void 0 === r ? C(x).removeProp(i) : x[i] = r, e[i] && (e.jsonpCallback = t.jsonpCallback, zt.push(i)), o && y(r) && r(o[0]), o = r = void 0
        }), "script"
    }), v.createHTMLDocument = (($t = T.implementation.createHTMLDocument("").body).innerHTML = "<form></form><form></form>", 2 === $t.childNodes.length), C.parseHTML = function(e, t, n) {
        return "string" != typeof e ? [] : ("boolean" == typeof t && (n = t, t = !1), t || (v.createHTMLDocument ? ((i = (t = T.implementation.createHTMLDocument("")).createElement("base")).href = T.location.href, t.head.appendChild(i)) : t = T), o = !n && [], (r = N.exec(e)) ? [t.createElement(r[1])] : (r = be([e], t, o), o && o.length && C(o).remove(), C.merge([], r.childNodes)));
        var i, r, o
    }, C.fn.load = function(e, t, n) {
        var i, r, o, s = this,
            a = e.indexOf(" ");
        return -1 < a && (i = gt(e.slice(a)), e = e.slice(0, a)), y(t) ? (n = t, t = void 0) : t && "object" == typeof t && (r = "POST"), 0 < s.length && C.ajax({
            url: e,
            type: r || "GET",
            dataType: "html",
            data: t
        }).done(function(e) {
            o = arguments, s.html(i ? C("<div>").append(C.parseHTML(e)).find(i) : e)
        }).always(n && function(e, t) {
            s.each(function() {
                n.apply(this, o || [e.responseText, t, e])
            })
        }), this
    }, C.expr.pseudos.animated = function(t) {
        return C.grep(C.timers, function(e) {
            return t === e.elem
        }).length
    }, C.offset = {
        setOffset: function(e, t, n) {
            var i, r, o, s, a, l, u = C.css(e, "position"),
                c = C(e),
                f = {};
            "static" === u && (e.style.position = "relative"), a = c.offset(), o = C.css(e, "top"), l = C.css(e, "left"), r = ("absolute" === u || "fixed" === u) && -1 < (o + l).indexOf("auto") ? (s = (i = c.position()).top, i.left) : (s = parseFloat(o) || 0, parseFloat(l) || 0), y(t) && (t = t.call(e, n, C.extend({}, a))), null != t.top && (f.top = t.top - a.top + s), null != t.left && (f.left = t.left - a.left + r), "using" in t ? t.using.call(e, f) : ("number" == typeof f.top && (f.top += "px"), "number" == typeof f.left && (f.left += "px"), c.css(f))
        }
    }, C.fn.extend({
        offset: function(t) {
            if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                C.offset.setOffset(this, t, e)
            });
            var e, n, i = this[0];
            return i ? i.getClientRects().length ? (e = i.getBoundingClientRect(), n = i.ownerDocument.defaultView, {
                top: e.top + n.pageYOffset,
                left: e.left + n.pageXOffset
            }) : {
                top: 0,
                left: 0
            } : void 0
        },
        position: function() {
            if (this[0]) {
                var e, t, n, i = this[0],
                    r = {
                        top: 0,
                        left: 0
                    };
                if ("fixed" === C.css(i, "position")) t = i.getBoundingClientRect();
                else {
                    for (t = this.offset(), n = i.ownerDocument, e = i.offsetParent || n.documentElement; e && (e === n.body || e === n.documentElement) && "static" === C.css(e, "position");) e = e.parentNode;
                    e && e !== i && 1 === e.nodeType && ((r = C(e).offset()).top += C.css(e, "borderTopWidth", !0), r.left += C.css(e, "borderLeftWidth", !0))
                }
                return {
                    top: t.top - r.top - C.css(i, "marginTop", !0),
                    left: t.left - r.left - C.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var e = this.offsetParent; e && "static" === C.css(e, "position");) e = e.offsetParent;
                return e || ie
            })
        }
    }), C.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(t, r) {
        var o = "pageYOffset" === r;
        C.fn[t] = function(e) {
            return W(this, function(e, t, n) {
                var i;
                if (b(e) ? i = e : 9 === e.nodeType && (i = e.defaultView), void 0 === n) return i ? i[r] : e[t];
                i ? i.scrollTo(o ? i.pageXOffset : n, o ? n : i.pageYOffset) : e[t] = n
            }, t, e, arguments.length)
        }
    }), C.each(["top", "left"], function(e, n) {
        C.cssHooks[n] = We(v.pixelPosition, function(e, t) {
            if (t) return t = Be(e, n), He.test(t) ? C(e).position()[n] + "px" : t
        })
    }), C.each({
        Height: "height",
        Width: "width"
    }, function(s, a) {
        C.each({
            padding: "inner" + s,
            content: a,
            "": "outer" + s
        }, function(i, o) {
            C.fn[o] = function(e, t) {
                var n = arguments.length && (i || "boolean" != typeof e),
                    r = i || (!0 === e || !0 === t ? "margin" : "border");
                return W(this, function(e, t, n) {
                    var i;
                    return b(e) ? 0 === o.indexOf("outer") ? e["inner" + s] : e.document.documentElement["client" + s] : 9 === e.nodeType ? (i = e.documentElement, Math.max(e.body["scroll" + s], i["scroll" + s], e.body["offset" + s], i["offset" + s], i["client" + s])) : void 0 === n ? C.css(e, t, r) : C.style(e, t, n, r)
                }, a, n ? e : void 0, n)
            }
        })
    }), C.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
        C.fn[t] = function(e) {
            return this.on(t, e)
        }
    }), C.fn.extend({
        bind: function(e, t, n) {
            return this.on(e, null, t, n)
        },
        unbind: function(e, t) {
            return this.off(e, null, t)
        },
        delegate: function(e, t, n, i) {
            return this.on(t, e, n, i)
        },
        undelegate: function(e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        },
        hover: function(e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }
    }), C.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function(e, n) {
        C.fn[n] = function(e, t) {
            return 0 < arguments.length ? this.on(n, null, e, t) : this.trigger(n)
        }
    });
    var Xt = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
    C.proxy = function(e, t) {
        var n, i, r;
        if ("string" == typeof t && (n = e[t], t = e, e = n), y(e)) return i = a.call(arguments, 2), (r = function() {
            return e.apply(t || this, i.concat(a.call(arguments)))
        }).guid = e.guid = e.guid || C.guid++, r
    }, C.holdReady = function(e) {
        e ? C.readyWait++ : C.ready(!0)
    }, C.isArray = Array.isArray, C.parseJSON = JSON.parse, C.nodeName = D, C.isFunction = y, C.isWindow = b, C.camelCase = z, C.type = w, C.now = Date.now, C.isNumeric = function(e) {
        var t = C.type(e);
        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
    }, C.trim = function(e) {
        return null == e ? "" : (e + "").replace(Xt, "")
    }, "function" == typeof define && define.amd && define("jquery", [], function() {
        return C
    });
    var Yt = x.jQuery,
        Kt = x.$;
    return C.noConflict = function(e) {
        return x.$ === C && (x.$ = Kt), e && x.jQuery === C && (x.jQuery = Yt), C
    }, void 0 === e && (x.jQuery = x.$ = C), C
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.Popper = t()
}(this, function() {
    "use strict";

    function s(e) {
        return e && "[object Function]" === {}.toString.call(e)
    }

    function _(e, t) {
        if (1 !== e.nodeType) return [];
        var n = getComputedStyle(e, null);
        return t ? n[t] : n
    }

    function y(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host
    }

    function b(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body
        }
        var t = _(e),
            n = t.overflow,
            i = t.overflowX,
            r = t.overflowY;
        return /(auto|scroll)/.test(n + r + i) ? e : b(y(e))
    }

    function w(e) {
        var t = e && e.offsetParent,
            n = t && t.nodeName;
        return n && "BODY" !== n && "HTML" !== n ? -1 !== ["TD", "TABLE"].indexOf(t.nodeName) && "static" === _(t, "position") ? w(t) : t : e ? e.ownerDocument.documentElement : document.documentElement
    }

    function c(e) {
        return null === e.parentNode ? e : c(e.parentNode)
    }

    function E(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            r = n ? t : e,
            o = document.createRange();
        o.setStart(i, 0), o.setEnd(r, 0);
        var s, a, l = o.commonAncestorContainer;
        if (e !== l && t !== l || i.contains(r)) return "BODY" === (a = (s = l).nodeName) || "HTML" !== a && w(s.firstElementChild) !== s ? w(l) : l;
        var u = c(e);
        return u.host ? E(u.host, t) : E(e, c(t).host)
    }

    function x(e) {
        var t = "top" === (1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;
        if ("BODY" !== n && "HTML" !== n) return e[t];
        var i = e.ownerDocument.documentElement;
        return (e.ownerDocument.scrollingElement || i)[t]
    }

    function f(e, t) {
        var n = "x" === t ? "Left" : "Top",
            i = "Left" == n ? "Right" : "Bottom";
        return parseFloat(e["border" + n + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10)
    }

    function i(e, t, n, i) {
        return H(t["offset" + e], t["scroll" + e], n["client" + e], n["offset" + e], n["scroll" + e], B() ? n["offset" + e] + i["margin" + ("Height" === e ? "Top" : "Left")] + i["margin" + ("Height" === e ? "Bottom" : "Right")] : 0)
    }

    function T() {
        var e = document.body,
            t = document.documentElement,
            n = B() && getComputedStyle(t);
        return {
            height: i("Height", e, t, n),
            width: i("Width", e, t, n)
        }
    }

    function C(e) {
        return Q({}, e, {
            right: e.left + e.width,
            bottom: e.top + e.height
        })
    }

    function S(e) {
        var t = {};
        if (B()) try {
            t = e.getBoundingClientRect();
            var n = x(e, "top"),
                i = x(e, "left");
            t.top += n, t.left += i, t.bottom += n, t.right += i
        } catch (e) {} else t = e.getBoundingClientRect();
        var r = {
                left: t.left,
                top: t.top,
                width: t.right - t.left,
                height: t.bottom - t.top
            },
            o = "HTML" === e.nodeName ? T() : {},
            s = o.width || e.clientWidth || r.right - r.left,
            a = o.height || e.clientHeight || r.bottom - r.top,
            l = e.offsetWidth - s,
            u = e.offsetHeight - a;
        if (l || u) {
            var c = _(e);
            l -= f(c, "x"), u -= f(c, "y"), r.width -= l, r.height -= u
        }
        return C(r)
    }

    function D(e, t) {
        var n = B(),
            i = "HTML" === t.nodeName,
            r = S(e),
            o = S(t),
            s = b(e),
            a = _(t),
            l = parseFloat(a.borderTopWidth, 10),
            u = parseFloat(a.borderLeftWidth, 10),
            c = C({
                top: r.top - o.top - l,
                left: r.left - o.left - u,
                width: r.width,
                height: r.height
            });
        if (c.marginTop = 0, c.marginLeft = 0, !n && i) {
            var f = parseFloat(a.marginTop, 10),
                d = parseFloat(a.marginLeft, 10);
            c.top -= l - f, c.bottom -= l - f, c.left -= u - d, c.right -= u - d, c.marginTop = f, c.marginLeft = d
        }
        return (n ? t.contains(s) : t === s && "BODY" !== s.nodeName) && (c = function(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                i = x(t, "top"),
                r = x(t, "left"),
                o = n ? -1 : 1;
            return e.top += i * o, e.bottom += i * o, e.left += r * o, e.right += r * o, e
        }(c, t)), c
    }

    function d(e, t, n, i) {
        var r, o, s, a, l, u, c, f = {
                top: 0,
                left: 0
            },
            d = E(e, t);
        if ("viewport" === i) o = (r = d).ownerDocument.documentElement, s = D(r, o), a = H(o.clientWidth, window.innerWidth || 0), l = H(o.clientHeight, window.innerHeight || 0), u = x(o), c = x(o, "left"), f = C({
            top: u - s.top + s.marginTop,
            left: c - s.left + s.marginLeft,
            width: a,
            height: l
        });
        else {
            var h;
            "scrollParent" === i ? "BODY" === (h = b(y(t))).nodeName && (h = e.ownerDocument.documentElement) : h = "window" === i ? e.ownerDocument.documentElement : i;
            var p = D(h, d);
            if ("HTML" !== h.nodeName || function e(t) {
                    var n = t.nodeName;
                    return "BODY" !== n && "HTML" !== n && ("fixed" === _(t, "position") || e(y(t)))
                }(d)) f = p;
            else {
                var m = T(),
                    g = m.height,
                    v = m.width;
                f.top += p.top - p.marginTop, f.bottom = g + p.top, f.left += p.left - p.marginLeft, f.right = v + p.left
            }
        }
        return f.left += n, f.top += n, f.right -= n, f.bottom -= n, f
    }

    function a(e, t, i, n, r) {
        var o = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
        if (-1 === e.indexOf("auto")) return e;
        var s = d(i, n, o, r),
            a = {
                top: {
                    width: s.width,
                    height: t.top - s.top
                },
                right: {
                    width: s.right - t.right,
                    height: s.height
                },
                bottom: {
                    width: s.width,
                    height: s.bottom - t.bottom
                },
                left: {
                    width: t.left - s.left,
                    height: s.height
                }
            },
            l = Object.keys(a).map(function(e) {
                return Q({
                    key: e
                }, a[e], {
                    area: (t = a[e], t.width * t.height)
                });
                var t
            }).sort(function(e, t) {
                return t.area - e.area
            }),
            u = l.filter(function(e) {
                var t = e.width,
                    n = e.height;
                return t >= i.clientWidth && n >= i.clientHeight
            }),
            c = 0 < u.length ? u[0].key : l[0].key,
            f = e.split("-")[1];
        return c + (f ? "-" + f : "")
    }

    function l(e, t, n) {
        return D(n, E(t, n))
    }

    function N(e) {
        var t = getComputedStyle(e),
            n = parseFloat(t.marginTop) + parseFloat(t.marginBottom),
            i = parseFloat(t.marginLeft) + parseFloat(t.marginRight);
        return {
            width: e.offsetWidth + i,
            height: e.offsetHeight + n
        }
    }

    function k(e) {
        var t = {
            left: "right",
            right: "left",
            bottom: "top",
            top: "bottom"
        };
        return e.replace(/left|right|bottom|top/g, function(e) {
            return t[e]
        })
    }

    function A(e, t, n) {
        n = n.split("-")[0];
        var i = N(e),
            r = {
                width: i.width,
                height: i.height
            },
            o = -1 !== ["right", "left"].indexOf(n),
            s = o ? "top" : "left",
            a = o ? "left" : "top",
            l = o ? "height" : "width",
            u = o ? "width" : "height";
        return r[s] = t[s] + t[l] / 2 - i[l] / 2, r[a] = n === a ? t[a] - i[u] : t[k(a)], r
    }

    function O(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0]
    }

    function j(e, n, t) {
        return (void 0 === t ? e : e.slice(0, function(e, t, n) {
            if (Array.prototype.findIndex) return e.findIndex(function(e) {
                return e[t] === n
            });
            var i = O(e, function(e) {
                return e[t] === n
            });
            return e.indexOf(i)
        }(e, "name", t))).forEach(function(e) {
            e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
            var t = e.function || e.fn;
            e.enabled && s(t) && (n.offsets.popper = C(n.offsets.popper), n.offsets.reference = C(n.offsets.reference), n = t(n, e))
        }), n
    }

    function e(e, n) {
        return e.some(function(e) {
            var t = e.name;
            return e.enabled && t === n
        })
    }

    function L(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], n = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < t.length - 1; i++) {
            var r = t[i],
                o = r ? "" + r + n : e;
            if (void 0 !== document.body.style[o]) return o
        }
        return null
    }

    function o(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window
    }

    function t(e, t, n, i) {
        n.updateBound = i, o(e).addEventListener("resize", n.updateBound, {
            passive: !0
        });
        var r = b(e);
        return function e(t, n, i, r) {
            var o = "BODY" === t.nodeName,
                s = o ? t.ownerDocument.defaultView : t;
            s.addEventListener(n, i, {
                passive: !0
            }), o || e(b(s.parentNode), n, i, r), r.push(s)
        }(r, "scroll", n.updateBound, n.scrollParents), n.scrollElement = r, n.eventsEnabled = !0, n
    }

    function n() {
        var e, t;
        this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (e = this.reference, t = this.state, o(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function(e) {
            e.removeEventListener("scroll", t.updateBound)
        }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t))
    }

    function h(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
    }

    function u(n, i) {
        Object.keys(i).forEach(function(e) {
            var t = ""; - 1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(e) && h(i[e]) && (t = "px"), n.style[e] = i[e] + t
        })
    }

    function I(e, t, n) {
        var i = O(e, function(e) {
                return e.name === t
            }),
            r = !!i && e.some(function(e) {
                return e.name === n && e.enabled && e.order < i.order
            });
        if (!r) {
            var o = "`" + t + "`";
            console.warn("`" + n + "` modifier is required by " + o + " modifier in order to work, be sure to include it before " + o + "!")
        }
        return r
    }

    function r(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            n = z.indexOf(e),
            i = z.slice(n + 1).concat(z.slice(0, n));
        return t ? i.reverse() : i
    }

    function p(e, r, o, t) {
        var s = [0, 0],
            a = -1 !== ["right", "left"].indexOf(t),
            n = e.split(/(\+|\-)/).map(function(e) {
                return e.trim()
            }),
            i = n.indexOf(O(n, function(e) {
                return -1 !== e.search(/,|\s/)
            }));
        n[i] && -1 === n[i].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
        var l = /\s*,\s*|\s+/,
            u = -1 === i ? [n] : [n.slice(0, i).concat([n[i].split(l)[0]]), [n[i].split(l)[1]].concat(n.slice(i + 1))];
        return (u = u.map(function(e, t) {
            var n = (1 === t ? !a : a) ? "height" : "width",
                i = !1;
            return e.reduce(function(e, t) {
                return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, i = !0, e) : i ? (e[e.length - 1] += t, i = !1, e) : e.concat(t)
            }, []).map(function(e) {
                return function(e, t, n, i) {
                    var r, o = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                        s = +o[1],
                        a = o[2];
                    if (!s) return e;
                    if (0 !== a.indexOf("%")) return "vh" !== a && "vw" !== a ? s : ("vh" === a ? H(document.documentElement.clientHeight, window.innerHeight || 0) : H(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * s;
                    switch (a) {
                        case "%p":
                            r = n;
                            break;
                        case "%":
                        case "%r":
                        default:
                            r = i
                    }
                    return C(r)[t] / 100 * s
                }(e, n, r, o)
            })
        })).forEach(function(n, i) {
            n.forEach(function(e, t) {
                h(e) && (s[i] += e * ("-" === n[t - 1] ? -1 : 1))
            })
        }), s
    }
    for (var P = Math.min, q = Math.floor, H = Math.max, m = "undefined" != typeof window && "undefined" != typeof document, g = ["Edge", "Trident", "Firefox"], v = 0, R = 0; R < g.length; R += 1)
        if (m && 0 <= navigator.userAgent.indexOf(g[R])) {
            v = 1;
            break
        } var F, M = m && window.Promise ? function(e) {
            var t = !1;
            return function() {
                t || (t = !0, window.Promise.resolve().then(function() {
                    t = !1, e()
                }))
            }
        } : function(e) {
            var t = !1;
            return function() {
                t || (t = !0, setTimeout(function() {
                    t = !1, e()
                }, v))
            }
        },
        B = function() {
            return null == F && (F = -1 !== navigator.appVersion.indexOf("MSIE 10")), F
        },
        W = function() {
            function i(e, t) {
                for (var n, i = 0; i < t.length; i++)(n = t[i]).enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
            return function(e, t, n) {
                return t && i(e.prototype, t), n && i(e, n), e
            }
        }(),
        U = function(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        },
        Q = Object.assign || function(e) {
            for (var t, n = 1; n < arguments.length; n++)
                for (var i in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
            return e
        },
        $ = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        z = $.slice(3),
        V = "flip",
        X = "clockwise",
        Y = "counterclockwise",
        K = function() {
            function o(e, t) {
                var n = this,
                    i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                (function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                })(this, o), this.scheduleUpdate = function() {
                    return requestAnimationFrame(n.update)
                }, this.update = M(this.update.bind(this)), this.options = Q({}, o.Defaults, i), this.state = {
                    isDestroyed: !1,
                    isCreated: !1,
                    scrollParents: []
                }, this.reference = e && e.jquery ? e[0] : e, this.popper = t && t.jquery ? t[0] : t, this.options.modifiers = {}, Object.keys(Q({}, o.Defaults.modifiers, i.modifiers)).forEach(function(e) {
                    n.options.modifiers[e] = Q({}, o.Defaults.modifiers[e] || {}, i.modifiers ? i.modifiers[e] : {})
                }), this.modifiers = Object.keys(this.options.modifiers).map(function(e) {
                    return Q({
                        name: e
                    }, n.options.modifiers[e])
                }).sort(function(e, t) {
                    return e.order - t.order
                }), this.modifiers.forEach(function(e) {
                    e.enabled && s(e.onLoad) && e.onLoad(n.reference, n.popper, n.options, e, n.state)
                }), this.update();
                var r = this.options.eventsEnabled;
                r && this.enableEventListeners(), this.state.eventsEnabled = r
            }
            return W(o, [{
                key: "update",
                value: function() {
                    return function() {
                        if (!this.state.isDestroyed) {
                            var e = {
                                instance: this,
                                styles: {},
                                arrowStyles: {},
                                attributes: {},
                                flipped: !1,
                                offsets: {}
                            };
                            e.offsets.reference = l(this.state, this.popper, this.reference), e.placement = a(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.offsets.popper = A(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = "absolute", e = j(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
                        }
                    }.call(this)
                }
            }, {
                key: "destroy",
                value: function() {
                    return function() {
                        return this.state.isDestroyed = !0, e(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.left = "", this.popper.style.position = "", this.popper.style.top = "", this.popper.style[L("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
                    }.call(this)
                }
            }, {
                key: "enableEventListeners",
                value: function() {
                    return function() {
                        this.state.eventsEnabled || (this.state = t(this.reference, this.options, this.state, this.scheduleUpdate))
                    }.call(this)
                }
            }, {
                key: "disableEventListeners",
                value: function() {
                    return n.call(this)
                }
            }]), o
        }();
    return K.Utils = ("undefined" == typeof window ? global : window).PopperUtils, K.placements = $, K.Defaults = {
        placement: "bottom",
        eventsEnabled: !0,
        removeOnDestroy: !1,
        onCreate: function() {},
        onUpdate: function() {},
        modifiers: {
            shift: {
                order: 100,
                enabled: !0,
                fn: function(e) {
                    var t = e.placement,
                        n = t.split("-")[0],
                        i = t.split("-")[1];
                    if (i) {
                        var r = e.offsets,
                            o = r.reference,
                            s = r.popper,
                            a = -1 !== ["bottom", "top"].indexOf(n),
                            l = a ? "left" : "top",
                            u = a ? "width" : "height",
                            c = {
                                start: U({}, l, o[l]),
                                end: U({}, l, o[l] + o[u] - s[u])
                            };
                        e.offsets.popper = Q({}, s, c[i])
                    }
                    return e
                }
            },
            offset: {
                order: 200,
                enabled: !0,
                fn: function(e, t) {
                    var n, i = t.offset,
                        r = e.placement,
                        o = e.offsets,
                        s = o.popper,
                        a = o.reference,
                        l = r.split("-")[0];
                    return n = h(+i) ? [+i, 0] : p(i, s, a, l), "left" === l ? (s.top += n[0], s.left -= n[1]) : "right" === l ? (s.top += n[0], s.left += n[1]) : "top" === l ? (s.left += n[0], s.top -= n[1]) : "bottom" === l && (s.left += n[0], s.top += n[1]), e.popper = s, e
                },
                offset: 0
            },
            preventOverflow: {
                order: 300,
                enabled: !0,
                fn: function(e, i) {
                    var t = i.boundariesElement || w(e.instance.popper);
                    e.instance.reference === t && (t = w(t));
                    var r = d(e.instance.popper, e.instance.reference, i.padding, t);
                    i.boundaries = r;
                    var n = i.priority,
                        o = e.offsets.popper,
                        s = {
                            primary: function(e) {
                                var t = o[e];
                                return o[e] < r[e] && !i.escapeWithReference && (t = H(o[e], r[e])), U({}, e, t)
                            },
                            secondary: function(e) {
                                var t = "right" === e ? "left" : "top",
                                    n = o[t];
                                return o[e] > r[e] && !i.escapeWithReference && (n = P(o[t], r[e] - ("right" === e ? o.width : o.height))), U({}, t, n)
                            }
                        };
                    return n.forEach(function(e) {
                        var t = -1 === ["left", "top"].indexOf(e) ? "secondary" : "primary";
                        o = Q({}, o, s[t](e))
                    }), e.offsets.popper = o, e
                },
                priority: ["left", "right", "top", "bottom"],
                padding: 5,
                boundariesElement: "scrollParent"
            },
            keepTogether: {
                order: 400,
                enabled: !0,
                fn: function(e) {
                    var t = e.offsets,
                        n = t.popper,
                        i = t.reference,
                        r = e.placement.split("-")[0],
                        o = q,
                        s = -1 !== ["top", "bottom"].indexOf(r),
                        a = s ? "right" : "bottom",
                        l = s ? "left" : "top",
                        u = s ? "width" : "height";
                    return n[a] < o(i[l]) && (e.offsets.popper[l] = o(i[l]) - n[u]), n[l] > o(i[a]) && (e.offsets.popper[l] = o(i[a])), e
                }
            },
            arrow: {
                order: 500,
                enabled: !0,
                fn: function(e, t) {
                    var n;
                    if (!I(e.instance.modifiers, "arrow", "keepTogether")) return e;
                    var i = t.element;
                    if ("string" == typeof i) {
                        if (!(i = e.instance.popper.querySelector(i))) return e
                    } else if (!e.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                    var r = e.placement.split("-")[0],
                        o = e.offsets,
                        s = o.popper,
                        a = o.reference,
                        l = -1 !== ["left", "right"].indexOf(r),
                        u = l ? "height" : "width",
                        c = l ? "Top" : "Left",
                        f = c.toLowerCase(),
                        d = l ? "left" : "top",
                        h = l ? "bottom" : "right",
                        p = N(i)[u];
                    a[h] - p < s[f] && (e.offsets.popper[f] -= s[f] - (a[h] - p)), a[f] + p > s[h] && (e.offsets.popper[f] += a[f] + p - s[h]), e.offsets.popper = C(e.offsets.popper);
                    var m = a[f] + a[u] / 2 - p / 2,
                        g = _(e.instance.popper),
                        v = parseFloat(g["margin" + c], 10),
                        y = parseFloat(g["border" + c + "Width"], 10),
                        b = m - e.offsets.popper[f] - v - y;
                    return b = H(P(s[u] - p, b), 0), e.arrowElement = i, e.offsets.arrow = (U(n = {}, f, Math.round(b)), U(n, d, ""), n), e
                },
                element: "[x-arrow]"
            },
            flip: {
                order: 600,
                enabled: !0,
                fn: function(p, m) {
                    if (e(p.instance.modifiers, "inner")) return p;
                    if (p.flipped && p.placement === p.originalPlacement) return p;
                    var g = d(p.instance.popper, p.instance.reference, m.padding, m.boundariesElement),
                        v = p.placement.split("-")[0],
                        y = k(v),
                        b = p.placement.split("-")[1] || "",
                        _ = [];
                    switch (m.behavior) {
                        case V:
                            _ = [v, y];
                            break;
                        case X:
                            _ = r(v);
                            break;
                        case Y:
                            _ = r(v, !0);
                            break;
                        default:
                            _ = m.behavior
                    }
                    return _.forEach(function(e, t) {
                        if (v !== e || _.length === t + 1) return p;
                        v = p.placement.split("-")[0], y = k(v);
                        var n, i = p.offsets.popper,
                            r = p.offsets.reference,
                            o = q,
                            s = "left" === v && o(i.right) > o(r.left) || "right" === v && o(i.left) < o(r.right) || "top" === v && o(i.bottom) > o(r.top) || "bottom" === v && o(i.top) < o(r.bottom),
                            a = o(i.left) < o(g.left),
                            l = o(i.right) > o(g.right),
                            u = o(i.top) < o(g.top),
                            c = o(i.bottom) > o(g.bottom),
                            f = "left" === v && a || "right" === v && l || "top" === v && u || "bottom" === v && c,
                            d = -1 !== ["top", "bottom"].indexOf(v),
                            h = !!m.flipVariations && (d && "start" === b && a || d && "end" === b && l || !d && "start" === b && u || !d && "end" === b && c);
                        (s || f || h) && (p.flipped = !0, (s || f) && (v = _[t + 1]), h && (b = "end" === (n = b) ? "start" : "start" === n ? "end" : n), p.placement = v + (b ? "-" + b : ""), p.offsets.popper = Q({}, p.offsets.popper, A(p.instance.popper, p.offsets.reference, p.placement)), p = j(p.instance.modifiers, p, "flip"))
                    }), p
                },
                behavior: "flip",
                padding: 5,
                boundariesElement: "viewport"
            },
            inner: {
                order: 700,
                enabled: !1,
                fn: function(e) {
                    var t = e.placement,
                        n = t.split("-")[0],
                        i = e.offsets,
                        r = i.popper,
                        o = i.reference,
                        s = -1 !== ["left", "right"].indexOf(n),
                        a = -1 === ["top", "left"].indexOf(n);
                    return r[s ? "left" : "top"] = o[n] - (a ? r[s ? "width" : "height"] : 0), e.placement = k(t), e.offsets.popper = C(r), e
                }
            },
            hide: {
                order: 800,
                enabled: !0,
                fn: function(e) {
                    if (!I(e.instance.modifiers, "hide", "preventOverflow")) return e;
                    var t = e.offsets.reference,
                        n = O(e.instance.modifiers, function(e) {
                            return "preventOverflow" === e.name
                        }).boundaries;
                    if (t.bottom < n.top || t.left > n.right || t.top > n.bottom || t.right < n.left) {
                        if (!0 === e.hide) return e;
                        e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
                    } else {
                        if (!1 === e.hide) return e;
                        e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
                    }
                    return e
                }
            },
            computeStyle: {
                order: 850,
                enabled: !0,
                fn: function(e, t) {
                    var n = t.x,
                        i = t.y,
                        r = e.offsets.popper,
                        o = O(e.instance.modifiers, function(e) {
                            return "applyStyle" === e.name
                        }).gpuAcceleration;
                    void 0 !== o && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                    var s, a, l = void 0 === o ? t.gpuAcceleration : o,
                        u = S(w(e.instance.popper)),
                        c = {
                            position: r.position
                        },
                        f = {
                            left: q(r.left),
                            top: q(r.top),
                            bottom: q(r.bottom),
                            right: q(r.right)
                        },
                        d = "bottom" === n ? "top" : "bottom",
                        h = "right" === i ? "left" : "right",
                        p = L("transform");
                    if (a = "bottom" == d ? -u.height + f.bottom : f.top, s = "right" == h ? -u.width + f.right : f.left, l && p) c[p] = "translate3d(" + s + "px, " + a + "px, 0)", c[d] = 0, c[h] = 0, c.willChange = "transform";
                    else {
                        var m = "bottom" == d ? -1 : 1,
                            g = "right" == h ? -1 : 1;
                        c[d] = a * m, c[h] = s * g, c.willChange = d + ", " + h
                    }
                    var v = {
                        "x-placement": e.placement
                    };
                    return e.attributes = Q({}, v, e.attributes), e.styles = Q({}, c, e.styles), e.arrowStyles = Q({}, e.offsets.arrow, e.arrowStyles), e
                },
                gpuAcceleration: !0,
                x: "bottom",
                y: "right"
            },
            applyStyle: {
                order: 900,
                enabled: !0,
                fn: function(e) {
                    return u(e.instance.popper, e.styles), t = e.instance.popper, n = e.attributes, Object.keys(n).forEach(function(e) {
                        !1 === n[e] ? t.removeAttribute(e) : t.setAttribute(e, n[e])
                    }), e.arrowElement && Object.keys(e.arrowStyles).length && u(e.arrowElement, e.arrowStyles), e;
                    var t, n
                },
                onLoad: function(e, t, n, i, r) {
                    var o = l(0, t, e),
                        s = a(n.placement, o, t, e, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);
                    return t.setAttribute("x-placement", s), u(t, {
                        position: "absolute"
                    }), n
                },
                gpuAcceleration: void 0
            }
        }
    }, K
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("jquery")) : "function" == typeof define && define.amd ? define(["exports", "jquery"], t) : t((e = e || self).bootstrap = {}, e.jQuery)
}(this, function(e, p) {
    "use strict";

    function i(e, t) {
        for (var n = 0; n < t.length; n++) {
            var i = t[n];
            i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
        }
    }

    function s(e, t, n) {
        return t && i(e.prototype, t), n && i(e, n), e
    }

    function t(t, e) {
        var n = Object.keys(t);
        if (Object.getOwnPropertySymbols) {
            var i = Object.getOwnPropertySymbols(t);
            e && (i = i.filter(function(e) {
                return Object.getOwnPropertyDescriptor(t, e).enumerable
            })), n.push.apply(n, i)
        }
        return n
    }

    function l(r) {
        for (var e = 1; e < arguments.length; e++) {
            var o = null != arguments[e] ? arguments[e] : {};
            e % 2 ? t(Object(o), !0).forEach(function(e) {
                var t, n, i;
                t = r, i = o[n = e], n in t ? Object.defineProperty(t, n, {
                    value: i,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : t[n] = i
            }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(r, Object.getOwnPropertyDescriptors(o)) : t(Object(o)).forEach(function(e) {
                Object.defineProperty(r, e, Object.getOwnPropertyDescriptor(o, e))
            })
        }
        return r
    }
    p = p && Object.prototype.hasOwnProperty.call(p, "default") ? p.default : p;
    var n = "transitionend";

    function r(e) {
        var t = this,
            n = !1;
        return p(this).one(m.TRANSITION_END, function() {
            n = !0
        }), setTimeout(function() {
            n || m.triggerTransitionEnd(t)
        }, e), this
    }
    var m = {
        TRANSITION_END: "bsTransitionEnd",
        getUID: function(e) {
            for (; e += ~~(1e6 * Math.random()), document.getElementById(e););
            return e
        },
        getSelectorFromElement: function(e) {
            var t = e.getAttribute("data-target");
            if (!t || "#" === t) {
                var n = e.getAttribute("href");
                t = n && "#" !== n ? n.trim() : ""
            }
            try {
                return document.querySelector(t) ? t : null
            } catch (e) {
                return null
            }
        },
        getTransitionDurationFromElement: function(e) {
            if (!e) return 0;
            var t = p(e).css("transition-duration"),
                n = p(e).css("transition-delay"),
                i = parseFloat(t),
                r = parseFloat(n);
            return i || r ? (t = t.split(",")[0], n = n.split(",")[0], 1e3 * (parseFloat(t) + parseFloat(n))) : 0
        },
        reflow: function(e) {
            return e.offsetHeight
        },
        triggerTransitionEnd: function(e) {
            p(e).trigger(n)
        },
        supportsTransitionEnd: function() {
            return Boolean(n)
        },
        isElement: function(e) {
            return (e[0] || e).nodeType
        },
        typeCheckConfig: function(e, t, n) {
            for (var i in n)
                if (Object.prototype.hasOwnProperty.call(n, i)) {
                    var r = n[i],
                        o = t[i],
                        s = o && m.isElement(o) ? "element" : null == (a = o) ? "" + a : {}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase();
                    if (!new RegExp(r).test(s)) throw new Error(e.toUpperCase() + ': Option "' + i + '" provided type "' + s + '" but expected type "' + r + '".')
                } var a
        },
        findShadowRoot: function(e) {
            if (!document.documentElement.attachShadow) return null;
            if ("function" != typeof e.getRootNode) return e instanceof ShadowRoot ? e : e.parentNode ? m.findShadowRoot(e.parentNode) : null;
            var t = e.getRootNode();
            return t instanceof ShadowRoot ? t : null
        },
        jQueryDetection: function() {
            if (void 0 === p) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
            var e = p.fn.jquery.split(" ")[0].split(".");
            if (e[0] < 2 && e[1] < 9 || 1 === e[0] && 9 === e[1] && e[2] < 1 || 4 <= e[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
        }
    };
    m.jQueryDetection(), p.fn.emulateTransitionEnd = r, p.event.special[m.TRANSITION_END] = {
        bindType: n,
        delegateType: n,
        handle: function(e) {
            if (p(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
        }
    };
    var o = "alert",
        a = "bs.alert",
        u = p.fn[o],
        c = function() {
            function i(e) {
                this._element = e
            }
            var e = i.prototype;
            return e.close = function(e) {
                var t = this._element;
                e && (t = this._getRootElement(e)), this._triggerCloseEvent(t).isDefaultPrevented() || this._removeElement(t)
            }, e.dispose = function() {
                p.removeData(this._element, a), this._element = null
            }, e._getRootElement = function(e) {
                var t = m.getSelectorFromElement(e),
                    n = !1;
                return t && (n = document.querySelector(t)), n || (n = p(e).closest(".alert")[0]), n
            }, e._triggerCloseEvent = function(e) {
                var t = p.Event("close.bs.alert");
                return p(e).trigger(t), t
            }, e._removeElement = function(t) {
                var n = this;
                if (p(t).removeClass("show"), p(t).hasClass("fade")) {
                    var e = m.getTransitionDurationFromElement(t);
                    p(t).one(m.TRANSITION_END, function(e) {
                        return n._destroyElement(t, e)
                    }).emulateTransitionEnd(e)
                } else this._destroyElement(t)
            }, e._destroyElement = function(e) {
                p(e).detach().trigger("closed.bs.alert").remove()
            }, i._jQueryInterface = function(n) {
                return this.each(function() {
                    var e = p(this),
                        t = e.data(a);
                    t || (t = new i(this), e.data(a, t)), "close" === n && t[n](this)
                })
            }, i._handleDismiss = function(t) {
                return function(e) {
                    e && e.preventDefault(), t.close(this)
                }
            }, s(i, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }]), i
        }();
    p(document).on("click.bs.alert.data-api", '[data-dismiss="alert"]', c._handleDismiss(new c)), p.fn[o] = c._jQueryInterface, p.fn[o].Constructor = c, p.fn[o].noConflict = function() {
        return p.fn[o] = u, c._jQueryInterface
    };
    var f = "button",
        d = "bs.button",
        h = p.fn[f],
        g = "active",
        v = '[data-toggle^="button"]',
        y = 'input:not([type="hidden"])',
        b = function() {
            function n(e) {
                this._element = e
            }
            var e = n.prototype;
            return e.toggle = function() {
                var e = !0,
                    t = !0,
                    n = p(this._element).closest('[data-toggle="buttons"]')[0];
                if (n) {
                    var i = this._element.querySelector(y);
                    if (i) {
                        if ("radio" === i.type)
                            if (i.checked && this._element.classList.contains(g)) e = !1;
                            else {
                                var r = n.querySelector(".active");
                                r && p(r).removeClass(g)
                            } e && ("checkbox" !== i.type && "radio" !== i.type || (i.checked = !this._element.classList.contains(g)), p(i).trigger("change")), i.focus(), t = !1
                    }
                }
                this._element.hasAttribute("disabled") || this._element.classList.contains("disabled") || (t && this._element.setAttribute("aria-pressed", !this._element.classList.contains(g)), e && p(this._element).toggleClass(g))
            }, e.dispose = function() {
                p.removeData(this._element, d), this._element = null
            }, n._jQueryInterface = function(t) {
                return this.each(function() {
                    var e = p(this).data(d);
                    e || (e = new n(this), p(this).data(d, e)), "toggle" === t && e[t]()
                })
            }, s(n, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }]), n
        }();
    p(document).on("click.bs.button.data-api", v, function(e) {
        var t = e.target,
            n = t;
        if (p(t).hasClass("btn") || (t = p(t).closest(".btn")[0]), !t || t.hasAttribute("disabled") || t.classList.contains("disabled")) e.preventDefault();
        else {
            var i = t.querySelector(y);
            if (i && (i.hasAttribute("disabled") || i.classList.contains("disabled"))) return void e.preventDefault();
            "LABEL" === n.tagName && i && "checkbox" === i.type && e.preventDefault(), b._jQueryInterface.call(p(t), "toggle")
        }
    }).on("focus.bs.button.data-api blur.bs.button.data-api", v, function(e) {
        var t = p(e.target).closest(".btn")[0];
        p(t).toggleClass("focus", /^focus(in)?$/.test(e.type))
    }), p(window).on("load.bs.button.data-api", function() {
        for (var e = [].slice.call(document.querySelectorAll('[data-toggle="buttons"] .btn')), t = 0, n = e.length; t < n; t++) {
            var i = e[t],
                r = i.querySelector(y);
            r.checked || r.hasAttribute("checked") ? i.classList.add(g) : i.classList.remove(g)
        }
        for (var o = 0, s = (e = [].slice.call(document.querySelectorAll('[data-toggle="button"]'))).length; o < s; o++) {
            var a = e[o];
            "true" === a.getAttribute("aria-pressed") ? a.classList.add(g) : a.classList.remove(g)
        }
    }), p.fn[f] = b._jQueryInterface, p.fn[f].Constructor = b, p.fn[f].noConflict = function() {
        return p.fn[f] = h, b._jQueryInterface
    };
    var _ = "carousel",
        w = "bs.carousel",
        E = "." + w,
        x = p.fn[_],
        T = {
            interval: 5e3,
            keyboard: !0,
            slide: !1,
            pause: "hover",
            wrap: !0,
            touch: !0
        },
        C = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            slide: "(boolean|string)",
            pause: "(string|boolean)",
            wrap: "boolean",
            touch: "boolean"
        },
        S = "next",
        D = "prev",
        N = "slid" + E,
        k = "active",
        A = ".active.carousel-item",
        O = {
            TOUCH: "touch",
            PEN: "pen"
        },
        j = function() {
            function o(e, t) {
                this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this.touchStartX = 0, this.touchDeltaX = 0, this._config = this._getConfig(t), this._element = e, this._indicatorsElement = this._element.querySelector(".carousel-indicators"), this._touchSupported = "ontouchstart" in document.documentElement || 0 < navigator.maxTouchPoints, this._pointerEvent = Boolean(window.PointerEvent || window.MSPointerEvent), this._addEventListeners()
            }
            var e = o.prototype;
            return e.next = function() {
                this._isSliding || this._slide(S)
            }, e.nextWhenVisible = function() {
                !document.hidden && p(this._element).is(":visible") && "hidden" !== p(this._element).css("visibility") && this.next()
            }, e.prev = function() {
                this._isSliding || this._slide(D)
            }, e.pause = function(e) {
                e || (this._isPaused = !0), this._element.querySelector(".carousel-item-next, .carousel-item-prev") && (m.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
            }, e.cycle = function(e) {
                e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval))
            }, e.to = function(e) {
                var t = this;
                this._activeElement = this._element.querySelector(A);
                var n = this._getItemIndex(this._activeElement);
                if (!(e > this._items.length - 1 || e < 0))
                    if (this._isSliding) p(this._element).one(N, function() {
                        return t.to(e)
                    });
                    else {
                        if (n === e) return this.pause(), void this.cycle();
                        var i = n < e ? S : D;
                        this._slide(i, this._items[e])
                    }
            }, e.dispose = function() {
                p(this._element).off(E), p.removeData(this._element, w), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
            }, e._getConfig = function(e) {
                return e = l(l({}, T), e), m.typeCheckConfig(_, e, C), e
            }, e._handleSwipe = function() {
                var e = Math.abs(this.touchDeltaX);
                if (!(e <= 40)) {
                    var t = e / this.touchDeltaX;
                    (this.touchDeltaX = 0) < t && this.prev(), t < 0 && this.next()
                }
            }, e._addEventListeners = function() {
                var t = this;
                this._config.keyboard && p(this._element).on("keydown.bs.carousel", function(e) {
                    return t._keydown(e)
                }), "hover" === this._config.pause && p(this._element).on("mouseenter.bs.carousel", function(e) {
                    return t.pause(e)
                }).on("mouseleave.bs.carousel", function(e) {
                    return t.cycle(e)
                }), this._config.touch && this._addTouchEventListeners()
            }, e._addTouchEventListeners = function() {
                var n = this;
                if (this._touchSupported) {
                    var t = function(e) {
                            n._pointerEvent && O[e.originalEvent.pointerType.toUpperCase()] ? n.touchStartX = e.originalEvent.clientX : n._pointerEvent || (n.touchStartX = e.originalEvent.touches[0].clientX)
                        },
                        i = function(e) {
                            n._pointerEvent && O[e.originalEvent.pointerType.toUpperCase()] && (n.touchDeltaX = e.originalEvent.clientX - n.touchStartX), n._handleSwipe(), "hover" === n._config.pause && (n.pause(), n.touchTimeout && clearTimeout(n.touchTimeout), n.touchTimeout = setTimeout(function(e) {
                                return n.cycle(e)
                            }, 500 + n._config.interval))
                        };
                    p(this._element.querySelectorAll(".carousel-item img")).on("dragstart.bs.carousel", function(e) {
                        return e.preventDefault()
                    }), this._pointerEvent ? (p(this._element).on("pointerdown.bs.carousel", function(e) {
                        return t(e)
                    }), p(this._element).on("pointerup.bs.carousel", function(e) {
                        return i(e)
                    }), this._element.classList.add("pointer-event")) : (p(this._element).on("touchstart.bs.carousel", function(e) {
                        return t(e)
                    }), p(this._element).on("touchmove.bs.carousel", function(e) {
                        var t;
                        (t = e).originalEvent.touches && 1 < t.originalEvent.touches.length ? n.touchDeltaX = 0 : n.touchDeltaX = t.originalEvent.touches[0].clientX - n.touchStartX
                    }), p(this._element).on("touchend.bs.carousel", function(e) {
                        return i(e)
                    }))
                }
            }, e._keydown = function(e) {
                if (!/input|textarea/i.test(e.target.tagName)) switch (e.which) {
                    case 37:
                        e.preventDefault(), this.prev();
                        break;
                    case 39:
                        e.preventDefault(), this.next()
                }
            }, e._getItemIndex = function(e) {
                return this._items = e && e.parentNode ? [].slice.call(e.parentNode.querySelectorAll(".carousel-item")) : [], this._items.indexOf(e)
            }, e._getItemByDirection = function(e, t) {
                var n = e === S,
                    i = e === D,
                    r = this._getItemIndex(t),
                    o = this._items.length - 1;
                if ((i && 0 === r || n && r === o) && !this._config.wrap) return t;
                var s = (r + (e === D ? -1 : 1)) % this._items.length;
                return -1 === s ? this._items[this._items.length - 1] : this._items[s]
            }, e._triggerSlideEvent = function(e, t) {
                var n = this._getItemIndex(e),
                    i = this._getItemIndex(this._element.querySelector(A)),
                    r = p.Event("slide.bs.carousel", {
                        relatedTarget: e,
                        direction: t,
                        from: i,
                        to: n
                    });
                return p(this._element).trigger(r), r
            }, e._setActiveIndicatorElement = function(e) {
                if (this._indicatorsElement) {
                    var t = [].slice.call(this._indicatorsElement.querySelectorAll(".active"));
                    p(t).removeClass(k);
                    var n = this._indicatorsElement.children[this._getItemIndex(e)];
                    n && p(n).addClass(k)
                }
            }, e._slide = function(e, t) {
                var n, i, r, o = this,
                    s = this._element.querySelector(A),
                    a = this._getItemIndex(s),
                    l = t || s && this._getItemByDirection(e, s),
                    u = this._getItemIndex(l),
                    c = Boolean(this._interval);
                if (r = e === S ? (n = "carousel-item-left", i = "carousel-item-next", "left") : (n = "carousel-item-right", i = "carousel-item-prev", "right"), l && p(l).hasClass(k)) this._isSliding = !1;
                else if (!this._triggerSlideEvent(l, r).isDefaultPrevented() && s && l) {
                    this._isSliding = !0, c && this.pause(), this._setActiveIndicatorElement(l);
                    var f = p.Event(N, {
                        relatedTarget: l,
                        direction: r,
                        from: a,
                        to: u
                    });
                    if (p(this._element).hasClass("slide")) {
                        p(l).addClass(i), m.reflow(l), p(s).addClass(n), p(l).addClass(n);
                        var d = parseInt(l.getAttribute("data-interval"), 10);
                        d ? (this._config.defaultInterval = this._config.defaultInterval || this._config.interval, this._config.interval = d) : this._config.interval = this._config.defaultInterval || this._config.interval;
                        var h = m.getTransitionDurationFromElement(s);
                        p(s).one(m.TRANSITION_END, function() {
                            p(l).removeClass(n + " " + i).addClass(k), p(s).removeClass(k + " " + i + " " + n), o._isSliding = !1, setTimeout(function() {
                                return p(o._element).trigger(f)
                            }, 0)
                        }).emulateTransitionEnd(h)
                    } else p(s).removeClass(k), p(l).addClass(k), this._isSliding = !1, p(this._element).trigger(f);
                    c && this.cycle()
                }
            }, o._jQueryInterface = function(i) {
                return this.each(function() {
                    var e = p(this).data(w),
                        t = l(l({}, T), p(this).data());
                    "object" == typeof i && (t = l(l({}, t), i));
                    var n = "string" == typeof i ? i : t.slide;
                    if (e || (e = new o(this, t), p(this).data(w, e)), "number" == typeof i) e.to(i);
                    else if ("string" == typeof n) {
                        if (void 0 === e[n]) throw new TypeError('No method named "' + n + '"');
                        e[n]()
                    } else t.interval && t.ride && (e.pause(), e.cycle())
                })
            }, o._dataApiClickHandler = function(e) {
                var t = m.getSelectorFromElement(this);
                if (t) {
                    var n = p(t)[0];
                    if (n && p(n).hasClass("carousel")) {
                        var i = l(l({}, p(n).data()), p(this).data()),
                            r = this.getAttribute("data-slide-to");
                        r && (i.interval = !1), o._jQueryInterface.call(p(n), i), r && p(n).data(w).to(r), e.preventDefault()
                    }
                }
            }, s(o, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return T
                }
            }]), o
        }();
    p(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", j._dataApiClickHandler), p(window).on("load.bs.carousel.data-api", function() {
        for (var e = [].slice.call(document.querySelectorAll('[data-ride="carousel"]')), t = 0, n = e.length; t < n; t++) {
            var i = p(e[t]);
            j._jQueryInterface.call(i, i.data())
        }
    }), p.fn[_] = j._jQueryInterface, p.fn[_].Constructor = j, p.fn[_].noConflict = function() {
        return p.fn[_] = x, j._jQueryInterface
    };
    var L = "collapse",
        I = "bs.collapse",
        P = p.fn[L],
        q = {
            toggle: !0,
            parent: ""
        },
        H = {
            toggle: "boolean",
            parent: "(string|element)"
        },
        R = "show",
        F = "collapse",
        M = "collapsing",
        B = "collapsed",
        W = '[data-toggle="collapse"]',
        U = function() {
            function a(t, e) {
                this._isTransitioning = !1, this._element = t, this._config = this._getConfig(e), this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + t.id + '"],[data-toggle="collapse"][data-target="#' + t.id + '"]'));
                for (var n = [].slice.call(document.querySelectorAll(W)), i = 0, r = n.length; i < r; i++) {
                    var o = n[i],
                        s = m.getSelectorFromElement(o),
                        a = [].slice.call(document.querySelectorAll(s)).filter(function(e) {
                            return e === t
                        });
                    null !== s && 0 < a.length && (this._selector = s, this._triggerArray.push(o))
                }
                this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
            }
            var e = a.prototype;
            return e.toggle = function() {
                p(this._element).hasClass(R) ? this.hide() : this.show()
            }, e.show = function() {
                var e, t, n = this;
                if (!this._isTransitioning && !p(this._element).hasClass(R) && (this._parent && 0 === (e = [].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter(function(e) {
                        return "string" == typeof n._config.parent ? e.getAttribute("data-parent") === n._config.parent : e.classList.contains(F)
                    })).length && (e = null), !(e && (t = p(e).not(this._selector).data(I)) && t._isTransitioning))) {
                    var i = p.Event("show.bs.collapse");
                    if (p(this._element).trigger(i), !i.isDefaultPrevented()) {
                        e && (a._jQueryInterface.call(p(e).not(this._selector), "hide"), t || p(e).data(I, null));
                        var r = this._getDimension();
                        p(this._element).removeClass(F).addClass(M), this._element.style[r] = 0, this._triggerArray.length && p(this._triggerArray).removeClass(B).attr("aria-expanded", !0), this.setTransitioning(!0);
                        var o = "scroll" + (r[0].toUpperCase() + r.slice(1)),
                            s = m.getTransitionDurationFromElement(this._element);
                        p(this._element).one(m.TRANSITION_END, function() {
                            p(n._element).removeClass(M).addClass(F + " " + R), n._element.style[r] = "", n.setTransitioning(!1), p(n._element).trigger("shown.bs.collapse")
                        }).emulateTransitionEnd(s), this._element.style[r] = this._element[o] + "px"
                    }
                }
            }, e.hide = function() {
                var e = this;
                if (!this._isTransitioning && p(this._element).hasClass(R)) {
                    var t = p.Event("hide.bs.collapse");
                    if (p(this._element).trigger(t), !t.isDefaultPrevented()) {
                        var n = this._getDimension();
                        this._element.style[n] = this._element.getBoundingClientRect()[n] + "px", m.reflow(this._element), p(this._element).addClass(M).removeClass(F + " " + R);
                        var i = this._triggerArray.length;
                        if (0 < i)
                            for (var r = 0; r < i; r++) {
                                var o = this._triggerArray[r],
                                    s = m.getSelectorFromElement(o);
                                if (null !== s) p([].slice.call(document.querySelectorAll(s))).hasClass(R) || p(o).addClass(B).attr("aria-expanded", !1)
                            }
                        this.setTransitioning(!0);
                        this._element.style[n] = "";
                        var a = m.getTransitionDurationFromElement(this._element);
                        p(this._element).one(m.TRANSITION_END, function() {
                            e.setTransitioning(!1), p(e._element).removeClass(M).addClass(F).trigger("hidden.bs.collapse")
                        }).emulateTransitionEnd(a)
                    }
                }
            }, e.setTransitioning = function(e) {
                this._isTransitioning = e
            }, e.dispose = function() {
                p.removeData(this._element, I), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
            }, e._getConfig = function(e) {
                return (e = l(l({}, q), e)).toggle = Boolean(e.toggle), m.typeCheckConfig(L, e, H), e
            }, e._getDimension = function() {
                return p(this._element).hasClass("width") ? "width" : "height"
            }, e._getParent = function() {
                var e, n = this;
                m.isElement(this._config.parent) ? (e = this._config.parent, void 0 !== this._config.parent.jquery && (e = this._config.parent[0])) : e = document.querySelector(this._config.parent);
                var t = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
                    i = [].slice.call(e.querySelectorAll(t));
                return p(i).each(function(e, t) {
                    n._addAriaAndCollapsedClass(a._getTargetFromElement(t), [t])
                }), e
            }, e._addAriaAndCollapsedClass = function(e, t) {
                var n = p(e).hasClass(R);
                t.length && p(t).toggleClass(B, !n).attr("aria-expanded", n)
            }, a._getTargetFromElement = function(e) {
                var t = m.getSelectorFromElement(e);
                return t ? document.querySelector(t) : null
            }, a._jQueryInterface = function(i) {
                return this.each(function() {
                    var e = p(this),
                        t = e.data(I),
                        n = l(l(l({}, q), e.data()), "object" == typeof i && i ? i : {});
                    if (!t && n.toggle && "string" == typeof i && /show|hide/.test(i) && (n.toggle = !1), t || (t = new a(this, n), e.data(I, t)), "string" == typeof i) {
                        if (void 0 === t[i]) throw new TypeError('No method named "' + i + '"');
                        t[i]()
                    }
                })
            }, s(a, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return q
                }
            }]), a
        }();
    p(document).on("click.bs.collapse.data-api", W, function(e) {
        "A" === e.currentTarget.tagName && e.preventDefault();
        var n = p(this),
            t = m.getSelectorFromElement(this),
            i = [].slice.call(document.querySelectorAll(t));
        p(i).each(function() {
            var e = p(this),
                t = e.data(I) ? "toggle" : n.data();
            U._jQueryInterface.call(e, t)
        })
    }), p.fn[L] = U._jQueryInterface, p.fn[L].Constructor = U, p.fn[L].noConflict = function() {
        return p.fn[L] = P, U._jQueryInterface
    };
    var Q = "undefined" != typeof window && "undefined" != typeof document && "undefined" != typeof navigator,
        $ = function() {
            for (var e = ["Edge", "Trident", "Firefox"], t = 0; t < e.length; t += 1)
                if (Q && 0 <= navigator.userAgent.indexOf(e[t])) return 1;
            return 0
        }();
    var z = Q && window.Promise ? function(e) {
        var t = !1;
        return function() {
            t || (t = !0, window.Promise.resolve().then(function() {
                t = !1, e()
            }))
        }
    } : function(e) {
        var t = !1;
        return function() {
            t || (t = !0, setTimeout(function() {
                t = !1, e()
            }, $))
        }
    };

    function V(e) {
        return e && "[object Function]" === {}.toString.call(e)
    }

    function X(e, t) {
        if (1 !== e.nodeType) return [];
        var n = e.ownerDocument.defaultView.getComputedStyle(e, null);
        return t ? n[t] : n
    }

    function Y(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host
    }

    function K(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body
        }
        var t = X(e),
            n = t.overflow,
            i = t.overflowX,
            r = t.overflowY;
        return /(auto|scroll|overlay)/.test(n + r + i) ? e : K(Y(e))
    }

    function G(e) {
        return e && e.referenceNode ? e.referenceNode : e
    }
    var J = Q && !(!window.MSInputMethodContext || !document.documentMode),
        Z = Q && /MSIE 10/.test(navigator.userAgent);

    function ee(e) {
        return 11 === e ? J : 10 === e ? Z : J || Z
    }

    function te(e) {
        if (!e) return document.documentElement;
        for (var t = ee(10) ? document.body : null, n = e.offsetParent || null; n === t && e.nextElementSibling;) n = (e = e.nextElementSibling).offsetParent;
        var i = n && n.nodeName;
        return i && "BODY" !== i && "HTML" !== i ? -1 !== ["TH", "TD", "TABLE"].indexOf(n.nodeName) && "static" === X(n, "position") ? te(n) : n : e ? e.ownerDocument.documentElement : document.documentElement
    }

    function ne(e) {
        return null !== e.parentNode ? ne(e.parentNode) : e
    }

    function ie(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            r = n ? t : e,
            o = document.createRange();
        o.setStart(i, 0), o.setEnd(r, 0);
        var s, a, l = o.commonAncestorContainer;
        if (e !== l && t !== l || i.contains(r)) return "BODY" === (a = (s = l).nodeName) || "HTML" !== a && te(s.firstElementChild) !== s ? te(l) : l;
        var u = ne(e);
        return u.host ? ie(u.host, t) : ie(e, ne(t).host)
    }

    function re(e) {
        var t = "top" === (1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;
        if ("BODY" !== n && "HTML" !== n) return e[t];
        var i = e.ownerDocument.documentElement;
        return (e.ownerDocument.scrollingElement || i)[t]
    }

    function oe(e, t) {
        var n = "x" === t ? "Left" : "Top",
            i = "Left" === n ? "Right" : "Bottom";
        return parseFloat(e["border" + n + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10)
    }

    function se(e, t, n, i) {
        return Math.max(t["offset" + e], t["scroll" + e], n["client" + e], n["offset" + e], n["scroll" + e], ee(10) ? parseInt(n["offset" + e]) + parseInt(i["margin" + ("Height" === e ? "Top" : "Left")]) + parseInt(i["margin" + ("Height" === e ? "Bottom" : "Right")]) : 0)
    }

    function ae(e) {
        var t = e.body,
            n = e.documentElement,
            i = ee(10) && getComputedStyle(n);
        return {
            height: se("Height", t, n, i),
            width: se("Width", t, n, i)
        }
    }
    var le = function() {
            function i(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var i = t[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
                }
            }
            return function(e, t, n) {
                return t && i(e.prototype, t), n && i(e, n), e
            }
        }(),
        ue = function(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        },
        ce = Object.assign || function(e) {
            for (var t = 1; t < arguments.length; t++) {
                var n = arguments[t];
                for (var i in n) Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i])
            }
            return e
        };

    function fe(e) {
        return ce({}, e, {
            right: e.left + e.width,
            bottom: e.top + e.height
        })
    }

    function de(e) {
        var t = {};
        try {
            if (ee(10)) {
                t = e.getBoundingClientRect();
                var n = re(e, "top"),
                    i = re(e, "left");
                t.top += n, t.left += i, t.bottom += n, t.right += i
            } else t = e.getBoundingClientRect()
        } catch (e) {}
        var r = {
                left: t.left,
                top: t.top,
                width: t.right - t.left,
                height: t.bottom - t.top
            },
            o = "HTML" === e.nodeName ? ae(e.ownerDocument) : {},
            s = o.width || e.clientWidth || r.width,
            a = o.height || e.clientHeight || r.height,
            l = e.offsetWidth - s,
            u = e.offsetHeight - a;
        if (l || u) {
            var c = X(e);
            l -= oe(c, "x"), u -= oe(c, "y"), r.width -= l, r.height -= u
        }
        return fe(r)
    }

    function he(e, t) {
        var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
            i = ee(10),
            r = "HTML" === t.nodeName,
            o = de(e),
            s = de(t),
            a = K(e),
            l = X(t),
            u = parseFloat(l.borderTopWidth, 10),
            c = parseFloat(l.borderLeftWidth, 10);
        n && r && (s.top = Math.max(s.top, 0), s.left = Math.max(s.left, 0));
        var f = fe({
            top: o.top - s.top - u,
            left: o.left - s.left - c,
            width: o.width,
            height: o.height
        });
        if (f.marginTop = 0, f.marginLeft = 0, !i && r) {
            var d = parseFloat(l.marginTop, 10),
                h = parseFloat(l.marginLeft, 10);
            f.top -= u - d, f.bottom -= u - d, f.left -= c - h, f.right -= c - h, f.marginTop = d, f.marginLeft = h
        }
        return (i && !n ? t.contains(a) : t === a && "BODY" !== a.nodeName) && (f = function(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                i = re(t, "top"),
                r = re(t, "left"),
                o = n ? -1 : 1;
            return e.top += i * o, e.bottom += i * o, e.left += r * o, e.right += r * o, e
        }(f, t)), f
    }

    function pe(e) {
        if (!e || !e.parentElement || ee()) return document.documentElement;
        for (var t = e.parentElement; t && "none" === X(t, "transform");) t = t.parentElement;
        return t || document.documentElement
    }

    function me(e, t, n, i) {
        var r = 4 < arguments.length && void 0 !== arguments[4] && arguments[4],
            o = {
                top: 0,
                left: 0
            },
            s = r ? pe(e) : ie(e, G(t));
        if ("viewport" === i) o = function(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                n = e.ownerDocument.documentElement,
                i = he(e, n),
                r = Math.max(n.clientWidth, window.innerWidth || 0),
                o = Math.max(n.clientHeight, window.innerHeight || 0),
                s = t ? 0 : re(n),
                a = t ? 0 : re(n, "left");
            return fe({
                top: s - i.top + i.marginTop,
                left: a - i.left + i.marginLeft,
                width: r,
                height: o
            })
        }(s, r);
        else {
            var a = void 0;
            "scrollParent" === i ? "BODY" === (a = K(Y(t))).nodeName && (a = e.ownerDocument.documentElement) : a = "window" === i ? e.ownerDocument.documentElement : i;
            var l = he(a, s, r);
            if ("HTML" !== a.nodeName || function e(t) {
                    var n = t.nodeName;
                    if ("BODY" === n || "HTML" === n) return !1;
                    if ("fixed" === X(t, "position")) return !0;
                    var i = Y(t);
                    return !!i && e(i)
                }(s)) o = l;
            else {
                var u = ae(e.ownerDocument),
                    c = u.height,
                    f = u.width;
                o.top += l.top - l.marginTop, o.bottom = c + l.top, o.left += l.left - l.marginLeft, o.right = f + l.left
            }
        }
        var d = "number" == typeof(n = n || 0);
        return o.left += d ? n : n.left || 0, o.top += d ? n : n.top || 0, o.right -= d ? n : n.right || 0, o.bottom -= d ? n : n.bottom || 0, o
    }

    function ge(e, t, i, n, r) {
        var o = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
        if (-1 === e.indexOf("auto")) return e;
        var s = me(i, n, o, r),
            a = {
                top: {
                    width: s.width,
                    height: t.top - s.top
                },
                right: {
                    width: s.right - t.right,
                    height: s.height
                },
                bottom: {
                    width: s.width,
                    height: s.bottom - t.bottom
                },
                left: {
                    width: t.left - s.left,
                    height: s.height
                }
            },
            l = Object.keys(a).map(function(e) {
                return ce({
                    key: e
                }, a[e], {
                    area: (t = a[e], t.width * t.height)
                });
                var t
            }).sort(function(e, t) {
                return t.area - e.area
            }),
            u = l.filter(function(e) {
                var t = e.width,
                    n = e.height;
                return t >= i.clientWidth && n >= i.clientHeight
            }),
            c = 0 < u.length ? u[0].key : l[0].key,
            f = e.split("-")[1];
        return c + (f ? "-" + f : "")
    }

    function ve(e, t, n) {
        var i = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : null;
        return he(n, i ? pe(t) : ie(t, G(n)), i)
    }

    function ye(e) {
        var t = e.ownerDocument.defaultView.getComputedStyle(e),
            n = parseFloat(t.marginTop || 0) + parseFloat(t.marginBottom || 0),
            i = parseFloat(t.marginLeft || 0) + parseFloat(t.marginRight || 0);
        return {
            width: e.offsetWidth + i,
            height: e.offsetHeight + n
        }
    }

    function be(e) {
        var t = {
            left: "right",
            right: "left",
            bottom: "top",
            top: "bottom"
        };
        return e.replace(/left|right|bottom|top/g, function(e) {
            return t[e]
        })
    }

    function _e(e, t, n) {
        n = n.split("-")[0];
        var i = ye(e),
            r = {
                width: i.width,
                height: i.height
            },
            o = -1 !== ["right", "left"].indexOf(n),
            s = o ? "top" : "left",
            a = o ? "left" : "top",
            l = o ? "height" : "width",
            u = o ? "width" : "height";
        return r[s] = t[s] + t[l] / 2 - i[l] / 2, r[a] = n === a ? t[a] - i[u] : t[be(a)], r
    }

    function we(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0]
    }

    function Ee(e, n, t) {
        return (void 0 === t ? e : e.slice(0, function(e, t, n) {
            if (Array.prototype.findIndex) return e.findIndex(function(e) {
                return e[t] === n
            });
            var i = we(e, function(e) {
                return e[t] === n
            });
            return e.indexOf(i)
        }(e, "name", t))).forEach(function(e) {
            e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
            var t = e.function || e.fn;
            e.enabled && V(t) && (n.offsets.popper = fe(n.offsets.popper), n.offsets.reference = fe(n.offsets.reference), n = t(n, e))
        }), n
    }

    function xe(e, n) {
        return e.some(function(e) {
            var t = e.name;
            return e.enabled && t === n
        })
    }

    function Te(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], n = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < t.length; i++) {
            var r = t[i],
                o = r ? "" + r + n : e;
            if (void 0 !== document.body.style[o]) return o
        }
        return null
    }

    function Ce(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window
    }

    function Se(e, t, n, i) {
        n.updateBound = i, Ce(e).addEventListener("resize", n.updateBound, {
            passive: !0
        });
        var r = K(e);
        return function e(t, n, i, r) {
            var o = "BODY" === t.nodeName,
                s = o ? t.ownerDocument.defaultView : t;
            s.addEventListener(n, i, {
                passive: !0
            }), o || e(K(s.parentNode), n, i, r), r.push(s)
        }(r, "scroll", n.updateBound, n.scrollParents), n.scrollElement = r, n.eventsEnabled = !0, n
    }

    function De() {
        var e, t;
        this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (e = this.reference, t = this.state, Ce(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function(e) {
            e.removeEventListener("scroll", t.updateBound)
        }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t))
    }

    function Ne(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
    }

    function ke(n, i) {
        Object.keys(i).forEach(function(e) {
            var t = ""; - 1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(e) && Ne(i[e]) && (t = "px"), n.style[e] = i[e] + t
        })
    }
    var Ae = Q && /Firefox/i.test(navigator.userAgent);

    function Oe(e, t, n) {
        var i = we(e, function(e) {
                return e.name === t
            }),
            r = !!i && e.some(function(e) {
                return e.name === n && e.enabled && e.order < i.order
            });
        if (!r) {
            var o = "`" + t + "`",
                s = "`" + n + "`";
            console.warn(s + " modifier is required by " + o + " modifier in order to work, be sure to include it before " + o + "!")
        }
        return r
    }
    var je = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        Le = je.slice(3);

    function Ie(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            n = Le.indexOf(e),
            i = Le.slice(n + 1).concat(Le.slice(0, n));
        return t ? i.reverse() : i
    }
    var Pe = "flip",
        qe = "clockwise",
        He = "counterclockwise";

    function Re(e, r, o, t) {
        var s = [0, 0],
            a = -1 !== ["right", "left"].indexOf(t),
            n = e.split(/(\+|\-)/).map(function(e) {
                return e.trim()
            }),
            i = n.indexOf(we(n, function(e) {
                return -1 !== e.search(/,|\s/)
            }));
        n[i] && -1 === n[i].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
        var l = /\s*,\s*|\s+/,
            u = -1 !== i ? [n.slice(0, i).concat([n[i].split(l)[0]]), [n[i].split(l)[1]].concat(n.slice(i + 1))] : [n];
        return (u = u.map(function(e, t) {
            var n = (1 === t ? !a : a) ? "height" : "width",
                i = !1;
            return e.reduce(function(e, t) {
                return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, i = !0, e) : i ? (e[e.length - 1] += t, i = !1, e) : e.concat(t)
            }, []).map(function(e) {
                return function(e, t, n, i) {
                    var r = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                        o = +r[1],
                        s = r[2];
                    if (!o) return e;
                    if (0 !== s.indexOf("%")) return "vh" !== s && "vw" !== s ? o : ("vh" === s ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0) : Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * o;
                    var a = void 0;
                    switch (s) {
                        case "%p":
                            a = n;
                            break;
                        case "%":
                        case "%r":
                        default:
                            a = i
                    }
                    return fe(a)[t] / 100 * o
                }(e, n, r, o)
            })
        })).forEach(function(n, i) {
            n.forEach(function(e, t) {
                Ne(e) && (s[i] += e * ("-" === n[t - 1] ? -1 : 1))
            })
        }), s
    }
    var Fe = {
            placement: "bottom",
            positionFixed: !1,
            eventsEnabled: !0,
            removeOnDestroy: !1,
            onCreate: function() {},
            onUpdate: function() {},
            modifiers: {
                shift: {
                    order: 100,
                    enabled: !0,
                    fn: function(e) {
                        var t = e.placement,
                            n = t.split("-")[0],
                            i = t.split("-")[1];
                        if (i) {
                            var r = e.offsets,
                                o = r.reference,
                                s = r.popper,
                                a = -1 !== ["bottom", "top"].indexOf(n),
                                l = a ? "left" : "top",
                                u = a ? "width" : "height",
                                c = {
                                    start: ue({}, l, o[l]),
                                    end: ue({}, l, o[l] + o[u] - s[u])
                                };
                            e.offsets.popper = ce({}, s, c[i])
                        }
                        return e
                    }
                },
                offset: {
                    order: 200,
                    enabled: !0,
                    fn: function(e, t) {
                        var n = t.offset,
                            i = e.placement,
                            r = e.offsets,
                            o = r.popper,
                            s = r.reference,
                            a = i.split("-")[0],
                            l = void 0;
                        return l = Ne(+n) ? [+n, 0] : Re(n, o, s, a), "left" === a ? (o.top += l[0], o.left -= l[1]) : "right" === a ? (o.top += l[0], o.left += l[1]) : "top" === a ? (o.left += l[0], o.top -= l[1]) : "bottom" === a && (o.left += l[0], o.top += l[1]), e.popper = o, e
                    },
                    offset: 0
                },
                preventOverflow: {
                    order: 300,
                    enabled: !0,
                    fn: function(e, i) {
                        var t = i.boundariesElement || te(e.instance.popper);
                        e.instance.reference === t && (t = te(t));
                        var n = Te("transform"),
                            r = e.instance.popper.style,
                            o = r.top,
                            s = r.left,
                            a = r[n];
                        r.top = "", r.left = "", r[n] = "";
                        var l = me(e.instance.popper, e.instance.reference, i.padding, t, e.positionFixed);
                        r.top = o, r.left = s, r[n] = a, i.boundaries = l;
                        var u = i.priority,
                            c = e.offsets.popper,
                            f = {
                                primary: function(e) {
                                    var t = c[e];
                                    return c[e] < l[e] && !i.escapeWithReference && (t = Math.max(c[e], l[e])), ue({}, e, t)
                                },
                                secondary: function(e) {
                                    var t = "right" === e ? "left" : "top",
                                        n = c[t];
                                    return c[e] > l[e] && !i.escapeWithReference && (n = Math.min(c[t], l[e] - ("right" === e ? c.width : c.height))), ue({}, t, n)
                                }
                            };
                        return u.forEach(function(e) {
                            var t = -1 !== ["left", "top"].indexOf(e) ? "primary" : "secondary";
                            c = ce({}, c, f[t](e))
                        }), e.offsets.popper = c, e
                    },
                    priority: ["left", "right", "top", "bottom"],
                    padding: 5,
                    boundariesElement: "scrollParent"
                },
                keepTogether: {
                    order: 400,
                    enabled: !0,
                    fn: function(e) {
                        var t = e.offsets,
                            n = t.popper,
                            i = t.reference,
                            r = e.placement.split("-")[0],
                            o = Math.floor,
                            s = -1 !== ["top", "bottom"].indexOf(r),
                            a = s ? "right" : "bottom",
                            l = s ? "left" : "top",
                            u = s ? "width" : "height";
                        return n[a] < o(i[l]) && (e.offsets.popper[l] = o(i[l]) - n[u]), n[l] > o(i[a]) && (e.offsets.popper[l] = o(i[a])), e
                    }
                },
                arrow: {
                    order: 500,
                    enabled: !0,
                    fn: function(e, t) {
                        var n;
                        if (!Oe(e.instance.modifiers, "arrow", "keepTogether")) return e;
                        var i = t.element;
                        if ("string" == typeof i) {
                            if (!(i = e.instance.popper.querySelector(i))) return e
                        } else if (!e.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                        var r = e.placement.split("-")[0],
                            o = e.offsets,
                            s = o.popper,
                            a = o.reference,
                            l = -1 !== ["left", "right"].indexOf(r),
                            u = l ? "height" : "width",
                            c = l ? "Top" : "Left",
                            f = c.toLowerCase(),
                            d = l ? "left" : "top",
                            h = l ? "bottom" : "right",
                            p = ye(i)[u];
                        a[h] - p < s[f] && (e.offsets.popper[f] -= s[f] - (a[h] - p)), a[f] + p > s[h] && (e.offsets.popper[f] += a[f] + p - s[h]), e.offsets.popper = fe(e.offsets.popper);
                        var m = a[f] + a[u] / 2 - p / 2,
                            g = X(e.instance.popper),
                            v = parseFloat(g["margin" + c], 10),
                            y = parseFloat(g["border" + c + "Width"], 10),
                            b = m - e.offsets.popper[f] - v - y;
                        return b = Math.max(Math.min(s[u] - p, b), 0), e.arrowElement = i, e.offsets.arrow = (ue(n = {}, f, Math.round(b)), ue(n, d, ""), n), e
                    },
                    element: "[x-arrow]"
                },
                flip: {
                    order: 600,
                    enabled: !0,
                    fn: function(g, v) {
                        if (xe(g.instance.modifiers, "inner")) return g;
                        if (g.flipped && g.placement === g.originalPlacement) return g;
                        var y = me(g.instance.popper, g.instance.reference, v.padding, v.boundariesElement, g.positionFixed),
                            b = g.placement.split("-")[0],
                            _ = be(b),
                            w = g.placement.split("-")[1] || "",
                            E = [];
                        switch (v.behavior) {
                            case Pe:
                                E = [b, _];
                                break;
                            case qe:
                                E = Ie(b);
                                break;
                            case He:
                                E = Ie(b, !0);
                                break;
                            default:
                                E = v.behavior
                        }
                        return E.forEach(function(e, t) {
                            if (b !== e || E.length === t + 1) return g;
                            b = g.placement.split("-")[0], _ = be(b);
                            var n, i = g.offsets.popper,
                                r = g.offsets.reference,
                                o = Math.floor,
                                s = "left" === b && o(i.right) > o(r.left) || "right" === b && o(i.left) < o(r.right) || "top" === b && o(i.bottom) > o(r.top) || "bottom" === b && o(i.top) < o(r.bottom),
                                a = o(i.left) < o(y.left),
                                l = o(i.right) > o(y.right),
                                u = o(i.top) < o(y.top),
                                c = o(i.bottom) > o(y.bottom),
                                f = "left" === b && a || "right" === b && l || "top" === b && u || "bottom" === b && c,
                                d = -1 !== ["top", "bottom"].indexOf(b),
                                h = !!v.flipVariations && (d && "start" === w && a || d && "end" === w && l || !d && "start" === w && u || !d && "end" === w && c),
                                p = !!v.flipVariationsByContent && (d && "start" === w && l || d && "end" === w && a || !d && "start" === w && c || !d && "end" === w && u),
                                m = h || p;
                            (s || f || m) && (g.flipped = !0, (s || f) && (b = E[t + 1]), m && (w = "end" === (n = w) ? "start" : "start" === n ? "end" : n), g.placement = b + (w ? "-" + w : ""), g.offsets.popper = ce({}, g.offsets.popper, _e(g.instance.popper, g.offsets.reference, g.placement)), g = Ee(g.instance.modifiers, g, "flip"))
                        }), g
                    },
                    behavior: "flip",
                    padding: 5,
                    boundariesElement: "viewport",
                    flipVariations: !1,
                    flipVariationsByContent: !1
                },
                inner: {
                    order: 700,
                    enabled: !1,
                    fn: function(e) {
                        var t = e.placement,
                            n = t.split("-")[0],
                            i = e.offsets,
                            r = i.popper,
                            o = i.reference,
                            s = -1 !== ["left", "right"].indexOf(n),
                            a = -1 === ["top", "left"].indexOf(n);
                        return r[s ? "left" : "top"] = o[n] - (a ? r[s ? "width" : "height"] : 0), e.placement = be(t), e.offsets.popper = fe(r), e
                    }
                },
                hide: {
                    order: 800,
                    enabled: !0,
                    fn: function(e) {
                        if (!Oe(e.instance.modifiers, "hide", "preventOverflow")) return e;
                        var t = e.offsets.reference,
                            n = we(e.instance.modifiers, function(e) {
                                return "preventOverflow" === e.name
                            }).boundaries;
                        if (t.bottom < n.top || t.left > n.right || t.top > n.bottom || t.right < n.left) {
                            if (!0 === e.hide) return e;
                            e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
                        } else {
                            if (!1 === e.hide) return e;
                            e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
                        }
                        return e
                    }
                },
                computeStyle: {
                    order: 850,
                    enabled: !0,
                    fn: function(e, t) {
                        var n = t.x,
                            i = t.y,
                            r = e.offsets.popper,
                            o = we(e.instance.modifiers, function(e) {
                                return "applyStyle" === e.name
                            }).gpuAcceleration;
                        void 0 !== o && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                        var s, a, l, u, c, f, d, h, p, m, g, v, y, b, _ = void 0 !== o ? o : t.gpuAcceleration,
                            w = te(e.instance.popper),
                            E = de(w),
                            x = {
                                position: r.position
                            },
                            T = (s = e, a = window.devicePixelRatio < 2 || !Ae, l = s.offsets, u = l.popper, c = l.reference, f = Math.round, d = Math.floor, h = function(e) {
                                return e
                            }, p = f(c.width), m = f(u.width), g = -1 !== ["left", "right"].indexOf(s.placement), v = -1 !== s.placement.indexOf("-"), b = a ? f : h, {
                                left: (y = a ? g || v || p % 2 == m % 2 ? f : d : h)(p % 2 == 1 && m % 2 == 1 && !v && a ? u.left - 1 : u.left),
                                top: b(u.top),
                                bottom: b(u.bottom),
                                right: y(u.right)
                            }),
                            C = "bottom" === n ? "top" : "bottom",
                            S = "right" === i ? "left" : "right",
                            D = Te("transform"),
                            N = void 0,
                            k = void 0;
                        if (k = "bottom" === C ? "HTML" === w.nodeName ? -w.clientHeight + T.bottom : -E.height + T.bottom : T.top, N = "right" === S ? "HTML" === w.nodeName ? -w.clientWidth + T.right : -E.width + T.right : T.left, _ && D) x[D] = "translate3d(" + N + "px, " + k + "px, 0)", x[C] = 0, x[S] = 0, x.willChange = "transform";
                        else {
                            var A = "bottom" === C ? -1 : 1,
                                O = "right" === S ? -1 : 1;
                            x[C] = k * A, x[S] = N * O, x.willChange = C + ", " + S
                        }
                        var j = {
                            "x-placement": e.placement
                        };
                        return e.attributes = ce({}, j, e.attributes), e.styles = ce({}, x, e.styles), e.arrowStyles = ce({}, e.offsets.arrow, e.arrowStyles), e
                    },
                    gpuAcceleration: !0,
                    x: "bottom",
                    y: "right"
                },
                applyStyle: {
                    order: 900,
                    enabled: !0,
                    fn: function(e) {
                        var t, n;
                        return ke(e.instance.popper, e.styles), t = e.instance.popper, n = e.attributes, Object.keys(n).forEach(function(e) {
                            !1 !== n[e] ? t.setAttribute(e, n[e]) : t.removeAttribute(e)
                        }), e.arrowElement && Object.keys(e.arrowStyles).length && ke(e.arrowElement, e.arrowStyles), e
                    },
                    onLoad: function(e, t, n, i, r) {
                        var o = ve(r, t, e, n.positionFixed),
                            s = ge(n.placement, o, t, e, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);
                        return t.setAttribute("x-placement", s), ke(t, {
                            position: n.positionFixed ? "fixed" : "absolute"
                        }), n
                    },
                    gpuAcceleration: void 0
                }
            }
        },
        Me = function() {
            function o(e, t) {
                var n = this,
                    i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, o), this.scheduleUpdate = function() {
                    return requestAnimationFrame(n.update)
                }, this.update = z(this.update.bind(this)), this.options = ce({}, o.Defaults, i), this.state = {
                    isDestroyed: !1,
                    isCreated: !1,
                    scrollParents: []
                }, this.reference = e && e.jquery ? e[0] : e, this.popper = t && t.jquery ? t[0] : t, this.options.modifiers = {}, Object.keys(ce({}, o.Defaults.modifiers, i.modifiers)).forEach(function(e) {
                    n.options.modifiers[e] = ce({}, o.Defaults.modifiers[e] || {}, i.modifiers ? i.modifiers[e] : {})
                }), this.modifiers = Object.keys(this.options.modifiers).map(function(e) {
                    return ce({
                        name: e
                    }, n.options.modifiers[e])
                }).sort(function(e, t) {
                    return e.order - t.order
                }), this.modifiers.forEach(function(e) {
                    e.enabled && V(e.onLoad) && e.onLoad(n.reference, n.popper, n.options, e, n.state)
                }), this.update();
                var r = this.options.eventsEnabled;
                r && this.enableEventListeners(), this.state.eventsEnabled = r
            }
            return le(o, [{
                key: "update",
                value: function() {
                    return function() {
                        if (!this.state.isDestroyed) {
                            var e = {
                                instance: this,
                                styles: {},
                                arrowStyles: {},
                                attributes: {},
                                flipped: !1,
                                offsets: {}
                            };
                            e.offsets.reference = ve(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = ge(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = _e(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", e = Ee(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
                        }
                    }.call(this)
                }
            }, {
                key: "destroy",
                value: function() {
                    return function() {
                        return this.state.isDestroyed = !0, xe(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[Te("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
                    }.call(this)
                }
            }, {
                key: "enableEventListeners",
                value: function() {
                    return function() {
                        this.state.eventsEnabled || (this.state = Se(this.reference, this.options, this.state, this.scheduleUpdate))
                    }.call(this)
                }
            }, {
                key: "disableEventListeners",
                value: function() {
                    return De.call(this)
                }
            }]), o
        }();
    Me.Utils = ("undefined" != typeof window ? window : global).PopperUtils, Me.placements = je, Me.Defaults = Fe;
    var Be = "dropdown",
        We = "bs.dropdown",
        Ue = "." + We,
        Qe = ".data-api",
        $e = p.fn[Be],
        ze = new RegExp("38|40|27"),
        Ve = "hide" + Ue,
        Xe = "hidden" + Ue,
        Ye = "click" + Ue + Qe,
        Ke = "keydown" + Ue + Qe,
        Ge = "disabled",
        Je = "show",
        Ze = "dropdown-menu-right",
        et = '[data-toggle="dropdown"]',
        tt = ".dropdown-menu",
        nt = {
            offset: 0,
            flip: !0,
            boundary: "scrollParent",
            reference: "toggle",
            display: "dynamic",
            popperConfig: null
        },
        it = {
            offset: "(number|string|function)",
            flip: "boolean",
            boundary: "(string|element)",
            reference: "(string|element)",
            display: "string",
            popperConfig: "(null|object)"
        },
        rt = function() {
            function u(e, t) {
                this._element = e, this._popper = null, this._config = this._getConfig(t), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners()
            }
            var e = u.prototype;
            return e.toggle = function() {
                if (!this._element.disabled && !p(this._element).hasClass(Ge)) {
                    var e = p(this._menu).hasClass(Je);
                    u._clearMenus(), e || this.show(!0)
                }
            }, e.show = function(e) {
                if (void 0 === e && (e = !1), !(this._element.disabled || p(this._element).hasClass(Ge) || p(this._menu).hasClass(Je))) {
                    var t = {
                            relatedTarget: this._element
                        },
                        n = p.Event("show.bs.dropdown", t),
                        i = u._getParentFromElement(this._element);
                    if (p(i).trigger(n), !n.isDefaultPrevented()) {
                        if (!this._inNavbar && e) {
                            if (void 0 === Me) throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");
                            var r = this._element;
                            "parent" === this._config.reference ? r = i : m.isElement(this._config.reference) && (r = this._config.reference, void 0 !== this._config.reference.jquery && (r = this._config.reference[0])), "scrollParent" !== this._config.boundary && p(i).addClass("position-static"), this._popper = new Me(r, this._menu, this._getPopperConfig())
                        }
                        "ontouchstart" in document.documentElement && 0 === p(i).closest(".navbar-nav").length && p(document.body).children().on("mouseover", null, p.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), p(this._menu).toggleClass(Je), p(i).toggleClass(Je).trigger(p.Event("shown.bs.dropdown", t))
                    }
                }
            }, e.hide = function() {
                if (!this._element.disabled && !p(this._element).hasClass(Ge) && p(this._menu).hasClass(Je)) {
                    var e = {
                            relatedTarget: this._element
                        },
                        t = p.Event(Ve, e),
                        n = u._getParentFromElement(this._element);
                    p(n).trigger(t), t.isDefaultPrevented() || (this._popper && this._popper.destroy(), p(this._menu).toggleClass(Je), p(n).toggleClass(Je).trigger(p.Event(Xe, e)))
                }
            }, e.dispose = function() {
                p.removeData(this._element, We), p(this._element).off(Ue), this._element = null, (this._menu = null) !== this._popper && (this._popper.destroy(), this._popper = null)
            }, e.update = function() {
                this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate()
            }, e._addEventListeners = function() {
                var t = this;
                p(this._element).on("click.bs.dropdown", function(e) {
                    e.preventDefault(), e.stopPropagation(), t.toggle()
                })
            }, e._getConfig = function(e) {
                return e = l(l(l({}, this.constructor.Default), p(this._element).data()), e), m.typeCheckConfig(Be, e, this.constructor.DefaultType), e
            }, e._getMenuElement = function() {
                if (!this._menu) {
                    var e = u._getParentFromElement(this._element);
                    e && (this._menu = e.querySelector(tt))
                }
                return this._menu
            }, e._getPlacement = function() {
                var e = p(this._element.parentNode),
                    t = "bottom-start";
                return e.hasClass("dropup") ? t = p(this._menu).hasClass(Ze) ? "top-end" : "top-start" : e.hasClass("dropright") ? t = "right-start" : e.hasClass("dropleft") ? t = "left-start" : p(this._menu).hasClass(Ze) && (t = "bottom-end"), t
            }, e._detectNavbar = function() {
                return 0 < p(this._element).closest(".navbar").length
            }, e._getOffset = function() {
                var t = this,
                    e = {};
                return "function" == typeof this._config.offset ? e.fn = function(e) {
                    return e.offsets = l(l({}, e.offsets), t._config.offset(e.offsets, t._element) || {}), e
                } : e.offset = this._config.offset, e
            }, e._getPopperConfig = function() {
                var e = {
                    placement: this._getPlacement(),
                    modifiers: {
                        offset: this._getOffset(),
                        flip: {
                            enabled: this._config.flip
                        },
                        preventOverflow: {
                            boundariesElement: this._config.boundary
                        }
                    }
                };
                return "static" === this._config.display && (e.modifiers.applyStyle = {
                    enabled: !1
                }), l(l({}, e), this._config.popperConfig)
            }, u._jQueryInterface = function(t) {
                return this.each(function() {
                    var e = p(this).data(We);
                    if (e || (e = new u(this, "object" == typeof t ? t : null), p(this).data(We, e)), "string" == typeof t) {
                        if (void 0 === e[t]) throw new TypeError('No method named "' + t + '"');
                        e[t]()
                    }
                })
            }, u._clearMenus = function(e) {
                if (!e || 3 !== e.which && ("keyup" !== e.type || 9 === e.which))
                    for (var t = [].slice.call(document.querySelectorAll(et)), n = 0, i = t.length; n < i; n++) {
                        var r = u._getParentFromElement(t[n]),
                            o = p(t[n]).data(We),
                            s = {
                                relatedTarget: t[n]
                            };
                        if (e && "click" === e.type && (s.clickEvent = e), o) {
                            var a = o._menu;
                            if (p(r).hasClass(Je) && !(e && ("click" === e.type && /input|textarea/i.test(e.target.tagName) || "keyup" === e.type && 9 === e.which) && p.contains(r, e.target))) {
                                var l = p.Event(Ve, s);
                                p(r).trigger(l), l.isDefaultPrevented() || ("ontouchstart" in document.documentElement && p(document.body).children().off("mouseover", null, p.noop), t[n].setAttribute("aria-expanded", "false"), o._popper && o._popper.destroy(), p(a).removeClass(Je), p(r).removeClass(Je).trigger(p.Event(Xe, s)))
                            }
                        }
                    }
            }, u._getParentFromElement = function(e) {
                var t, n = m.getSelectorFromElement(e);
                return n && (t = document.querySelector(n)), t || e.parentNode
            }, u._dataApiKeydownHandler = function(e) {
                if ((/input|textarea/i.test(e.target.tagName) ? !(32 === e.which || 27 !== e.which && (40 !== e.which && 38 !== e.which || p(e.target).closest(tt).length)) : ze.test(e.which)) && !this.disabled && !p(this).hasClass(Ge)) {
                    var t = u._getParentFromElement(this),
                        n = p(t).hasClass(Je);
                    if (n || 27 !== e.which) {
                        if (e.preventDefault(), e.stopPropagation(), !n || n && (27 === e.which || 32 === e.which)) return 27 === e.which && p(t.querySelector(et)).trigger("focus"), void p(this).trigger("click");
                        var i = [].slice.call(t.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)")).filter(function(e) {
                            return p(e).is(":visible")
                        });
                        if (0 !== i.length) {
                            var r = i.indexOf(e.target);
                            38 === e.which && 0 < r && r--, 40 === e.which && r < i.length - 1 && r++, r < 0 && (r = 0), i[r].focus()
                        }
                    }
                }
            }, s(u, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return nt
                }
            }, {
                key: "DefaultType",
                get: function() {
                    return it
                }
            }]), u
        }();
    p(document).on(Ke, et, rt._dataApiKeydownHandler).on(Ke, tt, rt._dataApiKeydownHandler).on(Ye + " keyup.bs.dropdown.data-api", rt._clearMenus).on(Ye, et, function(e) {
        e.preventDefault(), e.stopPropagation(), rt._jQueryInterface.call(p(this), "toggle")
    }).on(Ye, ".dropdown form", function(e) {
        e.stopPropagation()
    }), p.fn[Be] = rt._jQueryInterface, p.fn[Be].Constructor = rt, p.fn[Be].noConflict = function() {
        return p.fn[Be] = $e, rt._jQueryInterface
    };
    var ot = "modal",
        st = "bs.modal",
        at = "." + st,
        lt = p.fn[ot],
        ut = {
            backdrop: !0,
            keyboard: !0,
            focus: !0,
            show: !0
        },
        ct = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            focus: "boolean",
            show: "boolean"
        },
        ft = "hidden" + at,
        dt = "show" + at,
        ht = "focusin" + at,
        pt = "resize" + at,
        mt = "click.dismiss" + at,
        gt = "keydown.dismiss" + at,
        vt = "mousedown.dismiss" + at,
        yt = "modal-open",
        bt = "fade",
        _t = "show",
        wt = "modal-static",
        Et = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        xt = ".sticky-top",
        Tt = function() {
            function r(e, t) {
                this._config = this._getConfig(t), this._element = e, this._dialog = e.querySelector(".modal-dialog"), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._isTransitioning = !1, this._scrollbarWidth = 0
            }
            var e = r.prototype;
            return e.toggle = function(e) {
                return this._isShown ? this.hide() : this.show(e)
            }, e.show = function(e) {
                var t = this;
                if (!this._isShown && !this._isTransitioning) {
                    p(this._element).hasClass(bt) && (this._isTransitioning = !0);
                    var n = p.Event(dt, {
                        relatedTarget: e
                    });
                    p(this._element).trigger(n), this._isShown || n.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), this._setEscapeEvent(), this._setResizeEvent(), p(this._element).on(mt, '[data-dismiss="modal"]', function(e) {
                        return t.hide(e)
                    }), p(this._dialog).on(vt, function() {
                        p(t._element).one("mouseup.dismiss.bs.modal", function(e) {
                            p(e.target).is(t._element) && (t._ignoreBackdropClick = !0)
                        })
                    }), this._showBackdrop(function() {
                        return t._showElement(e)
                    }))
                }
            }, e.hide = function(e) {
                var t = this;
                if (e && e.preventDefault(), this._isShown && !this._isTransitioning) {
                    var n = p.Event("hide.bs.modal");
                    if (p(this._element).trigger(n), this._isShown && !n.isDefaultPrevented()) {
                        this._isShown = !1;
                        var i = p(this._element).hasClass(bt);
                        if (i && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), p(document).off(ht), p(this._element).removeClass(_t), p(this._element).off(mt), p(this._dialog).off(vt), i) {
                            var r = m.getTransitionDurationFromElement(this._element);
                            p(this._element).one(m.TRANSITION_END, function(e) {
                                return t._hideModal(e)
                            }).emulateTransitionEnd(r)
                        } else this._hideModal()
                    }
                }
            }, e.dispose = function() {
                [window, this._element, this._dialog].forEach(function(e) {
                    return p(e).off(at)
                }), p(document).off(ht), p.removeData(this._element, st), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._isTransitioning = null, this._scrollbarWidth = null
            }, e.handleUpdate = function() {
                this._adjustDialog()
            }, e._getConfig = function(e) {
                return e = l(l({}, ut), e), m.typeCheckConfig(ot, e, ct), e
            }, e._triggerBackdropTransition = function() {
                var e = this;
                if ("static" === this._config.backdrop) {
                    var t = p.Event("hidePrevented.bs.modal");
                    if (p(this._element).trigger(t), t.defaultPrevented) return;
                    this._element.classList.add(wt);
                    var n = m.getTransitionDurationFromElement(this._element);
                    p(this._element).one(m.TRANSITION_END, function() {
                        e._element.classList.remove(wt)
                    }).emulateTransitionEnd(n), this._element.focus()
                } else this.hide()
            }, e._showElement = function(e) {
                var t = this,
                    n = p(this._element).hasClass(bt),
                    i = this._dialog ? this._dialog.querySelector(".modal-body") : null;
                this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), p(this._dialog).hasClass("modal-dialog-scrollable") && i ? i.scrollTop = 0 : this._element.scrollTop = 0, n && m.reflow(this._element), p(this._element).addClass(_t), this._config.focus && this._enforceFocus();
                var r = p.Event("shown.bs.modal", {
                        relatedTarget: e
                    }),
                    o = function() {
                        t._config.focus && t._element.focus(), t._isTransitioning = !1, p(t._element).trigger(r)
                    };
                if (n) {
                    var s = m.getTransitionDurationFromElement(this._dialog);
                    p(this._dialog).one(m.TRANSITION_END, o).emulateTransitionEnd(s)
                } else o()
            }, e._enforceFocus = function() {
                var t = this;
                p(document).off(ht).on(ht, function(e) {
                    document !== e.target && t._element !== e.target && 0 === p(t._element).has(e.target).length && t._element.focus()
                })
            }, e._setEscapeEvent = function() {
                var t = this;
                this._isShown ? p(this._element).on(gt, function(e) {
                    t._config.keyboard && 27 === e.which ? (e.preventDefault(), t.hide()) : t._config.keyboard || 27 !== e.which || t._triggerBackdropTransition()
                }) : this._isShown || p(this._element).off(gt)
            }, e._setResizeEvent = function() {
                var t = this;
                this._isShown ? p(window).on(pt, function(e) {
                    return t.handleUpdate(e)
                }) : p(window).off(pt)
            }, e._hideModal = function() {
                var e = this;
                this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._isTransitioning = !1, this._showBackdrop(function() {
                    p(document.body).removeClass(yt), e._resetAdjustments(), e._resetScrollbar(), p(e._element).trigger(ft)
                })
            }, e._removeBackdrop = function() {
                this._backdrop && (p(this._backdrop).remove(), this._backdrop = null)
            }, e._showBackdrop = function(e) {
                var t = this,
                    n = p(this._element).hasClass(bt) ? bt : "";
                if (this._isShown && this._config.backdrop) {
                    if (this._backdrop = document.createElement("div"), this._backdrop.className = "modal-backdrop", n && this._backdrop.classList.add(n), p(this._backdrop).appendTo(document.body), p(this._element).on(mt, function(e) {
                            t._ignoreBackdropClick ? t._ignoreBackdropClick = !1 : e.target === e.currentTarget && t._triggerBackdropTransition()
                        }), n && m.reflow(this._backdrop), p(this._backdrop).addClass(_t), !e) return;
                    if (!n) return void e();
                    var i = m.getTransitionDurationFromElement(this._backdrop);
                    p(this._backdrop).one(m.TRANSITION_END, e).emulateTransitionEnd(i)
                } else if (!this._isShown && this._backdrop) {
                    p(this._backdrop).removeClass(_t);
                    var r = function() {
                        t._removeBackdrop(), e && e()
                    };
                    if (p(this._element).hasClass(bt)) {
                        var o = m.getTransitionDurationFromElement(this._backdrop);
                        p(this._backdrop).one(m.TRANSITION_END, r).emulateTransitionEnd(o)
                    } else r()
                } else e && e()
            }, e._adjustDialog = function() {
                var e = this._element.scrollHeight > document.documentElement.clientHeight;
                !this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px")
            }, e._resetAdjustments = function() {
                this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
            }, e._checkScrollbar = function() {
                var e = document.body.getBoundingClientRect();
                this._isBodyOverflowing = Math.round(e.left + e.right) < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth()
            }, e._setScrollbar = function() {
                var r = this;
                if (this._isBodyOverflowing) {
                    var e = [].slice.call(document.querySelectorAll(Et)),
                        t = [].slice.call(document.querySelectorAll(xt));
                    p(e).each(function(e, t) {
                        var n = t.style.paddingRight,
                            i = p(t).css("padding-right");
                        p(t).data("padding-right", n).css("padding-right", parseFloat(i) + r._scrollbarWidth + "px")
                    }), p(t).each(function(e, t) {
                        var n = t.style.marginRight,
                            i = p(t).css("margin-right");
                        p(t).data("margin-right", n).css("margin-right", parseFloat(i) - r._scrollbarWidth + "px")
                    });
                    var n = document.body.style.paddingRight,
                        i = p(document.body).css("padding-right");
                    p(document.body).data("padding-right", n).css("padding-right", parseFloat(i) + this._scrollbarWidth + "px")
                }
                p(document.body).addClass(yt)
            }, e._resetScrollbar = function() {
                var e = [].slice.call(document.querySelectorAll(Et));
                p(e).each(function(e, t) {
                    var n = p(t).data("padding-right");
                    p(t).removeData("padding-right"), t.style.paddingRight = n || ""
                });
                var t = [].slice.call(document.querySelectorAll("" + xt));
                p(t).each(function(e, t) {
                    var n = p(t).data("margin-right");
                    void 0 !== n && p(t).css("margin-right", n).removeData("margin-right")
                });
                var n = p(document.body).data("padding-right");
                p(document.body).removeData("padding-right"), document.body.style.paddingRight = n || ""
            }, e._getScrollbarWidth = function() {
                var e = document.createElement("div");
                e.className = "modal-scrollbar-measure", document.body.appendChild(e);
                var t = e.getBoundingClientRect().width - e.clientWidth;
                return document.body.removeChild(e), t
            }, r._jQueryInterface = function(n, i) {
                return this.each(function() {
                    var e = p(this).data(st),
                        t = l(l(l({}, ut), p(this).data()), "object" == typeof n && n ? n : {});
                    if (e || (e = new r(this, t), p(this).data(st, e)), "string" == typeof n) {
                        if (void 0 === e[n]) throw new TypeError('No method named "' + n + '"');
                        e[n](i)
                    } else t.show && e.show(i)
                })
            }, s(r, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return ut
                }
            }]), r
        }();
    p(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(e) {
        var t, n = this,
            i = m.getSelectorFromElement(this);
        i && (t = document.querySelector(i));
        var r = p(t).data(st) ? "toggle" : l(l({}, p(t).data()), p(this).data());
        "A" !== this.tagName && "AREA" !== this.tagName || e.preventDefault();
        var o = p(t).one(dt, function(e) {
            e.isDefaultPrevented() || o.one(ft, function() {
                p(n).is(":visible") && n.focus()
            })
        });
        Tt._jQueryInterface.call(p(t), r, this)
    }), p.fn[ot] = Tt._jQueryInterface, p.fn[ot].Constructor = Tt, p.fn[ot].noConflict = function() {
        return p.fn[ot] = lt, Tt._jQueryInterface
    };
    var Ct = ["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"],
        St = {
            "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
            a: ["target", "href", "title", "rel"],
            area: [],
            b: [],
            br: [],
            col: [],
            code: [],
            div: [],
            em: [],
            hr: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            i: [],
            img: ["src", "srcset", "alt", "title", "width", "height"],
            li: [],
            ol: [],
            p: [],
            pre: [],
            s: [],
            small: [],
            span: [],
            sub: [],
            sup: [],
            strong: [],
            u: [],
            ul: []
        },
        Dt = /^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/gi,
        Nt = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i;

    function kt(e, s, t) {
        if (0 === e.length) return e;
        if (t && "function" == typeof t) return t(e);
        for (var n = (new window.DOMParser).parseFromString(e, "text/html"), a = Object.keys(s), l = [].slice.call(n.body.querySelectorAll("*")), i = function(e, t) {
                var n = l[e],
                    i = n.nodeName.toLowerCase();
                if (-1 === a.indexOf(n.nodeName.toLowerCase())) return n.parentNode.removeChild(n), "continue";
                var r = [].slice.call(n.attributes),
                    o = [].concat(s["*"] || [], s[i] || []);
                r.forEach(function(e) {
                    (function(e, t) {
                        var n = e.nodeName.toLowerCase();
                        if (-1 !== t.indexOf(n)) return -1 === Ct.indexOf(n) || Boolean(e.nodeValue.match(Dt) || e.nodeValue.match(Nt));
                        for (var i = t.filter(function(e) {
                                return e instanceof RegExp
                            }), r = 0, o = i.length; r < o; r++)
                            if (n.match(i[r])) return !0;
                        return !1
                    })(e, o) || n.removeAttribute(e.nodeName)
                })
            }, r = 0, o = l.length; r < o; r++) i(r);
        return n.body.innerHTML
    }
    var At = "tooltip",
        Ot = "bs.tooltip",
        jt = "." + Ot,
        Lt = p.fn[At],
        It = "bs-tooltip",
        Pt = new RegExp("(^|\\s)" + It + "\\S+", "g"),
        qt = ["sanitize", "whiteList", "sanitizeFn"],
        Ht = {
            animation: "boolean",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
            delay: "(number|object)",
            html: "boolean",
            selector: "(string|boolean)",
            placement: "(string|function)",
            offset: "(number|string|function)",
            container: "(string|element|boolean)",
            fallbackPlacement: "(string|array)",
            boundary: "(string|element)",
            sanitize: "boolean",
            sanitizeFn: "(null|function)",
            whiteList: "object",
            popperConfig: "(null|object)"
        },
        Rt = {
            AUTO: "auto",
            TOP: "top",
            RIGHT: "right",
            BOTTOM: "bottom",
            LEFT: "left"
        },
        Ft = {
            animation: !0,
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            selector: !1,
            placement: "top",
            offset: 0,
            container: !1,
            fallbackPlacement: "flip",
            boundary: "scrollParent",
            sanitize: !0,
            sanitizeFn: null,
            whiteList: St,
            popperConfig: null
        },
        Mt = "show",
        Bt = {
            HIDE: "hide" + jt,
            HIDDEN: "hidden" + jt,
            SHOW: "show" + jt,
            SHOWN: "shown" + jt,
            INSERTED: "inserted" + jt,
            CLICK: "click" + jt,
            FOCUSIN: "focusin" + jt,
            FOCUSOUT: "focusout" + jt,
            MOUSEENTER: "mouseenter" + jt,
            MOUSELEAVE: "mouseleave" + jt
        },
        Wt = "fade",
        Ut = "show",
        Qt = "hover",
        $t = "focus",
        zt = function() {
            function i(e, t) {
                if (void 0 === Me) throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");
                this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = e, this.config = this._getConfig(t), this.tip = null, this._setListeners()
            }
            var e = i.prototype;
            return e.enable = function() {
                this._isEnabled = !0
            }, e.disable = function() {
                this._isEnabled = !1
            }, e.toggleEnabled = function() {
                this._isEnabled = !this._isEnabled
            }, e.toggle = function(e) {
                if (this._isEnabled)
                    if (e) {
                        var t = this.constructor.DATA_KEY,
                            n = p(e.currentTarget).data(t);
                        n || (n = new this.constructor(e.currentTarget, this._getDelegateConfig()), p(e.currentTarget).data(t, n)), n._activeTrigger.click = !n._activeTrigger.click, n._isWithActiveTrigger() ? n._enter(null, n) : n._leave(null, n)
                    } else {
                        if (p(this.getTipElement()).hasClass(Ut)) return void this._leave(null, this);
                        this._enter(null, this)
                    }
            }, e.dispose = function() {
                clearTimeout(this._timeout), p.removeData(this.element, this.constructor.DATA_KEY), p(this.element).off(this.constructor.EVENT_KEY), p(this.element).closest(".modal").off("hide.bs.modal", this._hideModalHandler), this.tip && p(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, this._activeTrigger = null, this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null
            }, e.show = function() {
                var t = this;
                if ("none" === p(this.element).css("display")) throw new Error("Please use show on visible elements");
                var e = p.Event(this.constructor.Event.SHOW);
                if (this.isWithContent() && this._isEnabled) {
                    p(this.element).trigger(e);
                    var n = m.findShadowRoot(this.element),
                        i = p.contains(null !== n ? n : this.element.ownerDocument.documentElement, this.element);
                    if (e.isDefaultPrevented() || !i) return;
                    var r = this.getTipElement(),
                        o = m.getUID(this.constructor.NAME);
                    r.setAttribute("id", o), this.element.setAttribute("aria-describedby", o), this.setContent(), this.config.animation && p(r).addClass(Wt);
                    var s = "function" == typeof this.config.placement ? this.config.placement.call(this, r, this.element) : this.config.placement,
                        a = this._getAttachment(s);
                    this.addAttachmentClass(a);
                    var l = this._getContainer();
                    p(r).data(this.constructor.DATA_KEY, this), p.contains(this.element.ownerDocument.documentElement, this.tip) || p(r).appendTo(l), p(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new Me(this.element, r, this._getPopperConfig(a)), p(r).addClass(Ut), "ontouchstart" in document.documentElement && p(document.body).children().on("mouseover", null, p.noop);
                    var u = function() {
                        t.config.animation && t._fixTransition();
                        var e = t._hoverState;
                        t._hoverState = null, p(t.element).trigger(t.constructor.Event.SHOWN), "out" === e && t._leave(null, t)
                    };
                    if (p(this.tip).hasClass(Wt)) {
                        var c = m.getTransitionDurationFromElement(this.tip);
                        p(this.tip).one(m.TRANSITION_END, u).emulateTransitionEnd(c)
                    } else u()
                }
            }, e.hide = function(e) {
                var t = this,
                    n = this.getTipElement(),
                    i = p.Event(this.constructor.Event.HIDE),
                    r = function() {
                        t._hoverState !== Mt && n.parentNode && n.parentNode.removeChild(n), t._cleanTipClass(), t.element.removeAttribute("aria-describedby"), p(t.element).trigger(t.constructor.Event.HIDDEN), null !== t._popper && t._popper.destroy(), e && e()
                    };
                if (p(this.element).trigger(i), !i.isDefaultPrevented()) {
                    if (p(n).removeClass(Ut), "ontouchstart" in document.documentElement && p(document.body).children().off("mouseover", null, p.noop), this._activeTrigger.click = !1, this._activeTrigger[$t] = !1, this._activeTrigger[Qt] = !1, p(this.tip).hasClass(Wt)) {
                        var o = m.getTransitionDurationFromElement(n);
                        p(n).one(m.TRANSITION_END, r).emulateTransitionEnd(o)
                    } else r();
                    this._hoverState = ""
                }
            }, e.update = function() {
                null !== this._popper && this._popper.scheduleUpdate()
            }, e.isWithContent = function() {
                return Boolean(this.getTitle())
            }, e.addAttachmentClass = function(e) {
                p(this.getTipElement()).addClass(It + "-" + e)
            }, e.getTipElement = function() {
                return this.tip = this.tip || p(this.config.template)[0], this.tip
            }, e.setContent = function() {
                var e = this.getTipElement();
                this.setElementContent(p(e.querySelectorAll(".tooltip-inner")), this.getTitle()), p(e).removeClass(Wt + " " + Ut)
            }, e.setElementContent = function(e, t) {
                "object" != typeof t || !t.nodeType && !t.jquery ? this.config.html ? (this.config.sanitize && (t = kt(t, this.config.whiteList, this.config.sanitizeFn)), e.html(t)) : e.text(t) : this.config.html ? p(t).parent().is(e) || e.empty().append(t) : e.text(p(t).text())
            }, e.getTitle = function() {
                var e = this.element.getAttribute("data-original-title");
                return e || (e = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), e
            }, e._getPopperConfig = function(e) {
                var t = this;
                return l(l({}, {
                    placement: e,
                    modifiers: {
                        offset: this._getOffset(),
                        flip: {
                            behavior: this.config.fallbackPlacement
                        },
                        arrow: {
                            element: ".arrow"
                        },
                        preventOverflow: {
                            boundariesElement: this.config.boundary
                        }
                    },
                    onCreate: function(e) {
                        e.originalPlacement !== e.placement && t._handlePopperPlacementChange(e)
                    },
                    onUpdate: function(e) {
                        return t._handlePopperPlacementChange(e)
                    }
                }), this.config.popperConfig)
            }, e._getOffset = function() {
                var t = this,
                    e = {};
                return "function" == typeof this.config.offset ? e.fn = function(e) {
                    return e.offsets = l(l({}, e.offsets), t.config.offset(e.offsets, t.element) || {}), e
                } : e.offset = this.config.offset, e
            }, e._getContainer = function() {
                return !1 === this.config.container ? document.body : m.isElement(this.config.container) ? p(this.config.container) : p(document).find(this.config.container)
            }, e._getAttachment = function(e) {
                return Rt[e.toUpperCase()]
            }, e._setListeners = function() {
                var i = this;
                this.config.trigger.split(" ").forEach(function(e) {
                    if ("click" === e) p(i.element).on(i.constructor.Event.CLICK, i.config.selector, function(e) {
                        return i.toggle(e)
                    });
                    else if ("manual" !== e) {
                        var t = e === Qt ? i.constructor.Event.MOUSEENTER : i.constructor.Event.FOCUSIN,
                            n = e === Qt ? i.constructor.Event.MOUSELEAVE : i.constructor.Event.FOCUSOUT;
                        p(i.element).on(t, i.config.selector, function(e) {
                            return i._enter(e)
                        }).on(n, i.config.selector, function(e) {
                            return i._leave(e)
                        })
                    }
                }), this._hideModalHandler = function() {
                    i.element && i.hide()
                }, p(this.element).closest(".modal").on("hide.bs.modal", this._hideModalHandler), this.config.selector ? this.config = l(l({}, this.config), {}, {
                    trigger: "manual",
                    selector: ""
                }) : this._fixTitle()
            }, e._fixTitle = function() {
                var e = typeof this.element.getAttribute("data-original-title");
                (this.element.getAttribute("title") || "string" !== e) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
            }, e._enter = function(e, t) {
                var n = this.constructor.DATA_KEY;
                (t = t || p(e.currentTarget).data(n)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), p(e.currentTarget).data(n, t)), e && (t._activeTrigger["focusin" === e.type ? $t : Qt] = !0), p(t.getTipElement()).hasClass(Ut) || t._hoverState === Mt ? t._hoverState = Mt : (clearTimeout(t._timeout), t._hoverState = Mt, t.config.delay && t.config.delay.show ? t._timeout = setTimeout(function() {
                    t._hoverState === Mt && t.show()
                }, t.config.delay.show) : t.show())
            }, e._leave = function(e, t) {
                var n = this.constructor.DATA_KEY;
                (t = t || p(e.currentTarget).data(n)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), p(e.currentTarget).data(n, t)), e && (t._activeTrigger["focusout" === e.type ? $t : Qt] = !1), t._isWithActiveTrigger() || (clearTimeout(t._timeout), t._hoverState = "out", t.config.delay && t.config.delay.hide ? t._timeout = setTimeout(function() {
                    "out" === t._hoverState && t.hide()
                }, t.config.delay.hide) : t.hide())
            }, e._isWithActiveTrigger = function() {
                for (var e in this._activeTrigger)
                    if (this._activeTrigger[e]) return !0;
                return !1
            }, e._getConfig = function(e) {
                var t = p(this.element).data();
                return Object.keys(t).forEach(function(e) {
                    -1 !== qt.indexOf(e) && delete t[e]
                }), "number" == typeof(e = l(l(l({}, this.constructor.Default), t), "object" == typeof e && e ? e : {})).delay && (e.delay = {
                    show: e.delay,
                    hide: e.delay
                }), "number" == typeof e.title && (e.title = e.title.toString()), "number" == typeof e.content && (e.content = e.content.toString()), m.typeCheckConfig(At, e, this.constructor.DefaultType), e.sanitize && (e.template = kt(e.template, e.whiteList, e.sanitizeFn)), e
            }, e._getDelegateConfig = function() {
                var e = {};
                if (this.config)
                    for (var t in this.config) this.constructor.Default[t] !== this.config[t] && (e[t] = this.config[t]);
                return e
            }, e._cleanTipClass = function() {
                var e = p(this.getTipElement()),
                    t = e.attr("class").match(Pt);
                null !== t && t.length && e.removeClass(t.join(""))
            }, e._handlePopperPlacementChange = function(e) {
                this.tip = e.instance.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(e.placement))
            }, e._fixTransition = function() {
                var e = this.getTipElement(),
                    t = this.config.animation;
                null === e.getAttribute("x-placement") && (p(e).removeClass(Wt), this.config.animation = !1, this.hide(), this.show(), this.config.animation = t)
            }, i._jQueryInterface = function(n) {
                return this.each(function() {
                    var e = p(this).data(Ot),
                        t = "object" == typeof n && n;
                    if ((e || !/dispose|hide/.test(n)) && (e || (e = new i(this, t), p(this).data(Ot, e)), "string" == typeof n)) {
                        if (void 0 === e[n]) throw new TypeError('No method named "' + n + '"');
                        e[n]()
                    }
                })
            }, s(i, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return Ft
                }
            }, {
                key: "NAME",
                get: function() {
                    return At
                }
            }, {
                key: "DATA_KEY",
                get: function() {
                    return Ot
                }
            }, {
                key: "Event",
                get: function() {
                    return Bt
                }
            }, {
                key: "EVENT_KEY",
                get: function() {
                    return jt
                }
            }, {
                key: "DefaultType",
                get: function() {
                    return Ht
                }
            }]), i
        }();
    p.fn[At] = zt._jQueryInterface, p.fn[At].Constructor = zt, p.fn[At].noConflict = function() {
        return p.fn[At] = Lt, zt._jQueryInterface
    };
    var Vt = "popover",
        Xt = "bs.popover",
        Yt = "." + Xt,
        Kt = p.fn[Vt],
        Gt = "bs-popover",
        Jt = new RegExp("(^|\\s)" + Gt + "\\S+", "g"),
        Zt = l(l({}, zt.Default), {}, {
            placement: "right",
            trigger: "click",
            content: "",
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        }),
        en = l(l({}, zt.DefaultType), {}, {
            content: "(string|element|function)"
        }),
        tn = {
            HIDE: "hide" + Yt,
            HIDDEN: "hidden" + Yt,
            SHOW: "show" + Yt,
            SHOWN: "shown" + Yt,
            INSERTED: "inserted" + Yt,
            CLICK: "click" + Yt,
            FOCUSIN: "focusin" + Yt,
            FOCUSOUT: "focusout" + Yt,
            MOUSEENTER: "mouseenter" + Yt,
            MOUSELEAVE: "mouseleave" + Yt
        },
        nn = function(e) {
            var t, n;

            function i() {
                return e.apply(this, arguments) || this
            }
            n = e, (t = i).prototype = Object.create(n.prototype), (t.prototype.constructor = t).__proto__ = n;
            var r = i.prototype;
            return r.isWithContent = function() {
                return this.getTitle() || this._getContent()
            }, r.addAttachmentClass = function(e) {
                p(this.getTipElement()).addClass(Gt + "-" + e)
            }, r.getTipElement = function() {
                return this.tip = this.tip || p(this.config.template)[0], this.tip
            }, r.setContent = function() {
                var e = p(this.getTipElement());
                this.setElementContent(e.find(".popover-header"), this.getTitle());
                var t = this._getContent();
                "function" == typeof t && (t = t.call(this.element)), this.setElementContent(e.find(".popover-body"), t), e.removeClass("fade show")
            }, r._getContent = function() {
                return this.element.getAttribute("data-content") || this.config.content
            }, r._cleanTipClass = function() {
                var e = p(this.getTipElement()),
                    t = e.attr("class").match(Jt);
                null !== t && 0 < t.length && e.removeClass(t.join(""))
            }, i._jQueryInterface = function(n) {
                return this.each(function() {
                    var e = p(this).data(Xt),
                        t = "object" == typeof n ? n : null;
                    if ((e || !/dispose|hide/.test(n)) && (e || (e = new i(this, t), p(this).data(Xt, e)), "string" == typeof n)) {
                        if (void 0 === e[n]) throw new TypeError('No method named "' + n + '"');
                        e[n]()
                    }
                })
            }, s(i, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return Zt
                }
            }, {
                key: "NAME",
                get: function() {
                    return Vt
                }
            }, {
                key: "DATA_KEY",
                get: function() {
                    return Xt
                }
            }, {
                key: "Event",
                get: function() {
                    return tn
                }
            }, {
                key: "EVENT_KEY",
                get: function() {
                    return Yt
                }
            }, {
                key: "DefaultType",
                get: function() {
                    return en
                }
            }]), i
        }(zt);
    p.fn[Vt] = nn._jQueryInterface, p.fn[Vt].Constructor = nn, p.fn[Vt].noConflict = function() {
        return p.fn[Vt] = Kt, nn._jQueryInterface
    };
    var rn = "scrollspy",
        on = "bs.scrollspy",
        sn = "." + on,
        an = p.fn[rn],
        ln = {
            offset: 10,
            method: "auto",
            target: ""
        },
        un = {
            offset: "number",
            method: "string",
            target: "(string|element)"
        },
        cn = "active",
        fn = ".nav, .list-group",
        dn = ".nav-link",
        hn = ".list-group-item",
        pn = "position",
        mn = function() {
            function n(e, t) {
                var n = this;
                this._element = e, this._scrollElement = "BODY" === e.tagName ? window : e, this._config = this._getConfig(t), this._selector = this._config.target + " " + dn + "," + this._config.target + " " + hn + "," + this._config.target + " .dropdown-item", this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, p(this._scrollElement).on("scroll.bs.scrollspy", function(e) {
                    return n._process(e)
                }), this.refresh(), this._process()
            }
            var e = n.prototype;
            return e.refresh = function() {
                var t = this,
                    e = this._scrollElement === this._scrollElement.window ? "offset" : pn,
                    r = "auto" === this._config.method ? e : this._config.method,
                    o = r === pn ? this._getScrollTop() : 0;
                this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function(e) {
                    var t, n = m.getSelectorFromElement(e);
                    if (n && (t = document.querySelector(n)), t) {
                        var i = t.getBoundingClientRect();
                        if (i.width || i.height) return [p(t)[r]().top + o, n]
                    }
                    return null
                }).filter(function(e) {
                    return e
                }).sort(function(e, t) {
                    return e[0] - t[0]
                }).forEach(function(e) {
                    t._offsets.push(e[0]), t._targets.push(e[1])
                })
            }, e.dispose = function() {
                p.removeData(this._element, on), p(this._scrollElement).off(sn), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
            }, e._getConfig = function(e) {
                if ("string" != typeof(e = l(l({}, ln), "object" == typeof e && e ? e : {})).target && m.isElement(e.target)) {
                    var t = p(e.target).attr("id");
                    t || (t = m.getUID(rn), p(e.target).attr("id", t)), e.target = "#" + t
                }
                return m.typeCheckConfig(rn, e, un), e
            }, e._getScrollTop = function() {
                return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop
            }, e._getScrollHeight = function() {
                return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
            }, e._getOffsetHeight = function() {
                return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height
            }, e._process = function() {
                var e = this._getScrollTop() + this._config.offset,
                    t = this._getScrollHeight(),
                    n = this._config.offset + t - this._getOffsetHeight();
                if (this._scrollHeight !== t && this.refresh(), n <= e) {
                    var i = this._targets[this._targets.length - 1];
                    this._activeTarget !== i && this._activate(i)
                } else {
                    if (this._activeTarget && e < this._offsets[0] && 0 < this._offsets[0]) return this._activeTarget = null, void this._clear();
                    for (var r = this._offsets.length; r--;) {
                        this._activeTarget !== this._targets[r] && e >= this._offsets[r] && (void 0 === this._offsets[r + 1] || e < this._offsets[r + 1]) && this._activate(this._targets[r])
                    }
                }
            }, e._activate = function(t) {
                this._activeTarget = t, this._clear();
                var e = this._selector.split(",").map(function(e) {
                        return e + '[data-target="' + t + '"],' + e + '[href="' + t + '"]'
                    }),
                    n = p([].slice.call(document.querySelectorAll(e.join(","))));
                n.hasClass("dropdown-item") ? (n.closest(".dropdown").find(".dropdown-toggle").addClass(cn), n.addClass(cn)) : (n.addClass(cn), n.parents(fn).prev(dn + ", " + hn).addClass(cn), n.parents(fn).prev(".nav-item").children(dn).addClass(cn)), p(this._scrollElement).trigger("activate.bs.scrollspy", {
                    relatedTarget: t
                })
            }, e._clear = function() {
                [].slice.call(document.querySelectorAll(this._selector)).filter(function(e) {
                    return e.classList.contains(cn)
                }).forEach(function(e) {
                    return e.classList.remove(cn)
                })
            }, n._jQueryInterface = function(t) {
                return this.each(function() {
                    var e = p(this).data(on);
                    if (e || (e = new n(this, "object" == typeof t && t), p(this).data(on, e)), "string" == typeof t) {
                        if (void 0 === e[t]) throw new TypeError('No method named "' + t + '"');
                        e[t]()
                    }
                })
            }, s(n, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "Default",
                get: function() {
                    return ln
                }
            }]), n
        }();
    p(window).on("load.bs.scrollspy.data-api", function() {
        for (var e = [].slice.call(document.querySelectorAll('[data-spy="scroll"]')), t = e.length; t--;) {
            var n = p(e[t]);
            mn._jQueryInterface.call(n, n.data())
        }
    }), p.fn[rn] = mn._jQueryInterface, p.fn[rn].Constructor = mn, p.fn[rn].noConflict = function() {
        return p.fn[rn] = an, mn._jQueryInterface
    };
    var gn = "bs.tab",
        vn = p.fn.tab,
        yn = "active",
        bn = ".active",
        _n = "> li > .active",
        wn = function() {
            function i(e) {
                this._element = e
            }
            var e = i.prototype;
            return e.show = function() {
                var n = this;
                if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && p(this._element).hasClass(yn) || p(this._element).hasClass("disabled"))) {
                    var e, i, t = p(this._element).closest(".nav, .list-group")[0],
                        r = m.getSelectorFromElement(this._element);
                    if (t) {
                        var o = "UL" === t.nodeName || "OL" === t.nodeName ? _n : bn;
                        i = (i = p.makeArray(p(t).find(o)))[i.length - 1]
                    }
                    var s = p.Event("hide.bs.tab", {
                            relatedTarget: this._element
                        }),
                        a = p.Event("show.bs.tab", {
                            relatedTarget: i
                        });
                    if (i && p(i).trigger(s), p(this._element).trigger(a), !a.isDefaultPrevented() && !s.isDefaultPrevented()) {
                        r && (e = document.querySelector(r)), this._activate(this._element, t);
                        var l = function() {
                            var e = p.Event("hidden.bs.tab", {
                                    relatedTarget: n._element
                                }),
                                t = p.Event("shown.bs.tab", {
                                    relatedTarget: i
                                });
                            p(i).trigger(e), p(n._element).trigger(t)
                        };
                        e ? this._activate(e, e.parentNode, l) : l()
                    }
                }
            }, e.dispose = function() {
                p.removeData(this._element, gn), this._element = null
            }, e._activate = function(e, t, n) {
                var i = this,
                    r = (!t || "UL" !== t.nodeName && "OL" !== t.nodeName ? p(t).children(bn) : p(t).find(_n))[0],
                    o = n && r && p(r).hasClass("fade"),
                    s = function() {
                        return i._transitionComplete(e, r, n)
                    };
                if (r && o) {
                    var a = m.getTransitionDurationFromElement(r);
                    p(r).removeClass("show").one(m.TRANSITION_END, s).emulateTransitionEnd(a)
                } else s()
            }, e._transitionComplete = function(e, t, n) {
                if (t) {
                    p(t).removeClass(yn);
                    var i = p(t.parentNode).find("> .dropdown-menu .active")[0];
                    i && p(i).removeClass(yn), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !1)
                }
                if (p(e).addClass(yn), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !0), m.reflow(e), e.classList.contains("fade") && e.classList.add("show"), e.parentNode && p(e.parentNode).hasClass("dropdown-menu")) {
                    var r = p(e).closest(".dropdown")[0];
                    if (r) {
                        var o = [].slice.call(r.querySelectorAll(".dropdown-toggle"));
                        p(o).addClass(yn)
                    }
                    e.setAttribute("aria-expanded", !0)
                }
                n && n()
            }, i._jQueryInterface = function(n) {
                return this.each(function() {
                    var e = p(this),
                        t = e.data(gn);
                    if (t || (t = new i(this), e.data(gn, t)), "string" == typeof n) {
                        if (void 0 === t[n]) throw new TypeError('No method named "' + n + '"');
                        t[n]()
                    }
                })
            }, s(i, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }]), i
        }();
    p(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', function(e) {
        e.preventDefault(), wn._jQueryInterface.call(p(this), "show")
    }), p.fn.tab = wn._jQueryInterface, p.fn.tab.Constructor = wn, p.fn.tab.noConflict = function() {
        return p.fn.tab = vn, wn._jQueryInterface
    };
    var En = "toast",
        xn = "bs.toast",
        Tn = "." + xn,
        Cn = p.fn[En],
        Sn = "click.dismiss" + Tn,
        Dn = "show",
        Nn = "showing",
        kn = {
            animation: "boolean",
            autohide: "boolean",
            delay: "number"
        },
        An = {
            animation: !0,
            autohide: !0,
            delay: 500
        },
        On = function() {
            function i(e, t) {
                this._element = e, this._config = this._getConfig(t), this._timeout = null, this._setListeners()
            }
            var e = i.prototype;
            return e.show = function() {
                var e = this,
                    t = p.Event("show.bs.toast");
                if (p(this._element).trigger(t), !t.isDefaultPrevented()) {
                    this._config.animation && this._element.classList.add("fade");
                    var n = function() {
                        e._element.classList.remove(Nn), e._element.classList.add(Dn), p(e._element).trigger("shown.bs.toast"), e._config.autohide && (e._timeout = setTimeout(function() {
                            e.hide()
                        }, e._config.delay))
                    };
                    if (this._element.classList.remove("hide"), m.reflow(this._element), this._element.classList.add(Nn), this._config.animation) {
                        var i = m.getTransitionDurationFromElement(this._element);
                        p(this._element).one(m.TRANSITION_END, n).emulateTransitionEnd(i)
                    } else n()
                }
            }, e.hide = function() {
                if (this._element.classList.contains(Dn)) {
                    var e = p.Event("hide.bs.toast");
                    p(this._element).trigger(e), e.isDefaultPrevented() || this._close()
                }
            }, e.dispose = function() {
                clearTimeout(this._timeout), this._timeout = null, this._element.classList.contains(Dn) && this._element.classList.remove(Dn), p(this._element).off(Sn), p.removeData(this._element, xn), this._element = null, this._config = null
            }, e._getConfig = function(e) {
                return e = l(l(l({}, An), p(this._element).data()), "object" == typeof e && e ? e : {}), m.typeCheckConfig(En, e, this.constructor.DefaultType), e
            }, e._setListeners = function() {
                var e = this;
                p(this._element).on(Sn, '[data-dismiss="toast"]', function() {
                    return e.hide()
                })
            }, e._close = function() {
                var e = this,
                    t = function() {
                        e._element.classList.add("hide"), p(e._element).trigger("hidden.bs.toast")
                    };
                if (this._element.classList.remove(Dn), this._config.animation) {
                    var n = m.getTransitionDurationFromElement(this._element);
                    p(this._element).one(m.TRANSITION_END, t).emulateTransitionEnd(n)
                } else t()
            }, i._jQueryInterface = function(n) {
                return this.each(function() {
                    var e = p(this),
                        t = e.data(xn);
                    if (t || (t = new i(this, "object" == typeof n && n), e.data(xn, t)), "string" == typeof n) {
                        if (void 0 === t[n]) throw new TypeError('No method named "' + n + '"');
                        t[n](this)
                    }
                })
            }, s(i, null, [{
                key: "VERSION",
                get: function() {
                    return "4.5.0"
                }
            }, {
                key: "DefaultType",
                get: function() {
                    return kn
                }
            }, {
                key: "Default",
                get: function() {
                    return An
                }
            }]), i
        }();
    p.fn[En] = On._jQueryInterface, p.fn[En].Constructor = On, p.fn[En].noConflict = function() {
        return p.fn[En] = Cn, On._jQueryInterface
    }, e.Alert = c, e.Button = b, e.Carousel = j, e.Collapse = U, e.Dropdown = rt, e.Modal = Tt, e.Popover = nn, e.Scrollspy = mn, e.Tab = wn, e.Toast = On, e.Tooltip = zt, e.Util = m, Object.defineProperty(e, "__esModule", {
        value: !0
    })
});