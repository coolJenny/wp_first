! function(i) {
    i.fn.menumaker = function(n) {
        var e = i(this),
            t = i.extend({
                title: "Menu",
                format: "dropdown",
                sticky: !1
            }, n);
        return this.each(function() {
            return e.prepend('<div id="menu-button">' + t.title + "</div>"), i(this).find("#menu-button").on("click", function() {
                i(this).toggleClass("menu-opened");
                var n = i(this).next("ul");
                n.hasClass("open") ? n.hide().removeClass("open") : (n.show().addClass("open"), "dropdown" === t.format && n.find("ul").show())
            }), e.find("li ul").parent().addClass("has-sub"), multiTg = function() {
                e.find(".has-sub").prepend('<span class="submenu-button"></span>'), e.find(".submenu-button").on("click", function() {
                    i(this).toggleClass("submenu-opened"), i(this).siblings("ul").hasClass("open") ? i(this).siblings("ul").removeClass("open").hide() : i(this).siblings("ul").addClass("open").show()
                })
            }, "multitoggle" === t.format ? multiTg() : e.addClass("dropdown"), t.sticky === !0 && e.css("position", "fixed"), resizeFix = function() {
                i(window).width() > 768 && e.find("ul").show(), i(window).width() <= 768 && e.find("ul").hide().removeClass("open")
            }, resizeFix(), i(window).on("resize", resizeFix)
        })
    }
}(jQuery),
function(i) {
    i(document).ready(function() {
        i("#primary-menu").menumaker({
            title: "Menu",
            format: "multitoggle"
        }), i("#primary-menu").prepend("<div id='menu-line'></div>");
        var n, e, t, s, o = !1,
            u = 0,
            l = i("#primary-menu #menu-line");
        i("#primary-menu > ul > li").each(function() {
            i(this).hasClass("active") && (n = i(this), o = !0)
        }), o === !1 && (n = i("#primary-menu > ul > li").first()), s = e = n.width(), t = u = n.position().left, l.css("width", e), l.css("left", u), i("#primary-menu > ul > li").hover(function() {
            n = i(this), e = n.width(), u = n.position().left, l.css("width", e), l.css("left", u)
        }, function() {
            l.css("left", t), l.css("width", s)
        })
    })
}(jQuery);