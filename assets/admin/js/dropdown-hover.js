!(function (t, o) {
  var e = (function (t) {
    var o = {};
    function e(n) {
      if (o[n]) return o[n].exports;
      var d = (o[n] = { i: n, l: !1, exports: {} });
      return t[n].call(d.exports, d, d.exports, e), (d.l = !0), d.exports;
    }
    return (
      (e.m = t),
      (e.c = o),
      (e.d = function (t, o, n) {
        e.o(t, o) ||
          Object.defineProperty(t, o, {
            configurable: !1,
            enumerable: !0,
            get: n,
          });
      }),
      (e.r = function (t) {
        Object.defineProperty(t, "__esModule", { value: !0 });
      }),
      (e.n = function (t) {
        var o =
          t && t.__esModule
            ? function () {
                return t.default;
              }
            : function () {
                return t;
              };
        return e.d(o, "a", o), o;
      }),
      (e.o = function (t, o) {
        return Object.prototype.hasOwnProperty.call(t, o);
      }),
      (e.p = ""),
      e((e.s = 460))
    );
  })({
    460: function (t, o, e) {
      "use strict";
      !(function (t) {
        if (t && t.fn) {
          var o = "[data-toggle=dropdown][data-trigger=hover]",
            e = 150;
          t(function () {
            t("body")
              .on(
                "mouseenter",
                o + ", " + o + " ~ .dropdown-menu",
                function () {
                  t(this).hasClass("dropdown-toggle")
                    ? t(this)
                    : t(this).prev(".dropdown-toggle");
                  var e,
                    n,
                    d = t(this).hasClass("dropdown-menu")
                      ? t(this)
                      : t(this).next(".dropdown-menu");
                  "static" !==
                    window
                      .getComputedStyle(d[0], null)
                      .getPropertyValue("position") &&
                    (t(this).is(o) && t(this).data("hovered", !0),
                    (e = t(this).hasClass("dropdown-toggle")
                      ? t(this)
                      : t(this).prev(".dropdown-toggle")),
                    (n = e.data("dd-timeout")) &&
                      (clearTimeout(n), (n = null), e.data("dd-timeout", n)),
                    "true" !== e.attr("aria-expanded") && e.dropdown("toggle"));
                }
              )
              .on(
                "mouseleave",
                o + ", " + o + " ~ .dropdown-menu",
                function () {
                  t(this).hasClass("dropdown-toggle")
                    ? t(this)
                    : t(this).prev(".dropdown-toggle");
                  var n,
                    d,
                    r = t(this).hasClass("dropdown-menu")
                      ? t(this)
                      : t(this).next(".dropdown-menu");
                  "static" !==
                    window
                      .getComputedStyle(r[0], null)
                      .getPropertyValue("position") &&
                    (t(this).is(o) && t(this).data("hovered", !1),
                    (n = t(this).hasClass("dropdown-toggle")
                      ? t(this)
                      : t(this).prev(".dropdown-toggle")),
                    (d = n.data("dd-timeout")) && clearTimeout(d),
                    (d = setTimeout(function () {
                      var t = n.data("dd-timeout");
                      t &&
                        (clearTimeout(t), (t = null), n.data("dd-timeout", t)),
                        "true" === n.attr("aria-expanded") &&
                          n.dropdown("toggle");
                    }, e)),
                    n.data("dd-timeout", d));
                }
              )
              .on("hide.bs.dropdown", function (e) {
                t(this).find(o).data("hovered") && e.preventDefault();
              });
          });
        }
      })(window.jQuery);
    },
  });
  if ("object" == typeof e) {
    var n = [
      "object" == typeof module && "object" == typeof module.exports
        ? module.exports
        : null,
      "undefined" != typeof window ? window : null,
      t && t !== window ? t : null,
    ];
    for (var d in e)
      n[0] && (n[0][d] = e[d]),
        n[1] && "__esModule" !== d && (n[1][d] = e[d]),
        n[2] && (n[2][d] = e[d]);
  }
})(this);
