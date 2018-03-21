var Cozy;
! function(e) {
    "use strict";
    e(document).ready(function() {
        Cozy = {
            initialized: !1,
            mobMenuFlag: !1,
            mobileMenuTitle: mobileMenuTitle,
            twitter_username: twitter_username,
            agency_initialZoom: agency_initialZoom,
            agency_selectedZoom: agency_selectedZoom,
            agency_mapInitialLatitude: agency_mapInitialLatitude,
            agency_mapInitialLongitude: agency_mapInitialLongitude,
            agency_viewMore: agency_viewMore,
            properties_cluster_marker: properties_cluster_marker,
            properties_cluster_textcolor: properties_cluster_textcolor,
            properties_initialZoom: properties_initialZoom,
            properties_selectedZoom: properties_selectedZoom,
            properties_mapInitialLatitude: properties_mapInitialLatitude,
            properties_mapInitialLongitude: properties_mapInitialLongitude,
            properties_viewMore: properties_viewMore,
            use_default_map_style: use_default_map_style,
            sendingMail: !1,
            init: function() {
                var e = this;
                e.initialized || (e.initialized = !0, e.build(), e.events())
            },
            build: function() {
                var t = this;
                t.createMobileMenu(), t.getLatestTweets(), t.createOwlSliders(), t.createRevSlider(), t.createSelectBoxes(), t.createCheckBoxes(), t.propertiesGrid(), e("a[data-gal^='prettyPhoto']").length && e("a[data-gal^='prettyPhoto']").prettyPhoto({
                    theme: "cozy",
                    hook: "data-gal",
                    social_tools: !1
                }), e('[data-toggle="tooltip"]').tooltip(), t.parallaxItems(), e("input, textarea").placeholder()
            },
            events: function() {
                var e = this;
                e.windowResize(), e.stickyNav(), e.resizeSidebar(), e.buttonsClick(), e.initCountUp(), e.contactForm(), e.viewModeSwitcher(), e.animateElems()
            },
            createMobileMenu: function(t) {
                var i, a = this,
                    o = e("#wrapper"),
                    n = e.browser.mobile ? "touchstart" : "click";
                null !== t && (t = e(window).innerWidth()), 975 >= t && !a.mobMenuFlag && (e("body").prepend('<nav class="nav-mobile"><i class="fa fa-times"></i><h2><i class="fa fa-bars"></i>' + a.mobileMenuTitle + "</h2><ul></ul></nav>"), e(".nav-mobile > ul").html(e(".nav").html()), e(".nav-mobile b").remove(), e(".nav-mobile ul.dropdown-menu").removeClass().addClass("dropdown-mobile"), i = e(".nav-mobile"), e("#nav-mobile-btn").bind(n, function(t) {
                    t.stopPropagation(), t.preventDefault(), setTimeout(function() {
                        o.addClass("open"), i.addClass("open"), i.getNiceScroll().show()
                    }, 25), e.waypoints("disable"), e(document).bind(n, function(t) {
                        e(t.target).hasClass("nav-mobile") || e(t.target).parents(".nav-mobile").length || (o.removeClass("open"), i.removeClass("open"), e(document).unbind(n), e.waypoints("enable"))
                    }), e(">i", i).bind(n, function() {
                        i.getNiceScroll().hide(), o.removeClass("open"), i.removeClass("open"), e(document).unbind(n), e.waypoints("enable")
                    })
                }), i.niceScroll({
                    autohidemode: !0,
                    cursorcolor: "#c2c2c2",
                    cursoropacitymax: "0.7",
                    cursorwidth: 10,
                    cursorborder: "0px solid #000",
                    horizrailenabled: !1,
                    zindex: "1"
                }), i.getNiceScroll().hide(), a.mobMenuFlag = !0)
            },
            getLatestTweets: function() {
                var t = this,
                    i = document.createElement("div"),
                    a = e(".twitter .item").length,
                    o = 0;
                if (0 === a) return !1;
                i.setAttribute("id", "twitter-box"), e("body").append(i), e("#twitter-box").css({
                    display: "none"
                });
                try {
                    e("#twitter-box").tweet({
                        username: t.twitter_username,
                        modpath: "twitter/",
                        count: a,
                        loading_text: "Loading tweets...",
                        template: '<header><h3>{name}</h3><a href="http://twitter.com/{screen_name}" target="_blank">@{screen_name}</a>&nbsp;.&nbsp;<a href="http://twitter.com/{screen_name}/statuses/{tweet_id}/" target="_blank" class="time">{tweet_relative_time}</a></header><div class="text">{text}</div>'
                    })
                } catch (n) {
                    console.log("Your twitter account is misconfigured.")
                }
                e("#twitter-box li").each(function() {
                    return a > o ? (e(".twitter .item").eq(o).html(e(this).html()), void(o += 1)) : !1
                }), e("#twitter-box").remove()
            },
            createOwlSliders: function() {
                if (e("#new-properties-slider").length && e("#new-properties-slider").owlCarousel({
                        itemsCustom: [
                            [0, 1],
                            [590, 2],
                            [751, 2],
                            [975, 3],
                            [1183, 4],
                            [1440, 4],
                            [1728, 4]
                        ]
                    }), e("#property-gallery").length && e("#property-gallery").owlCarousel({
                        navigation: !0,
                        navigationText: !1,
                        pagination: !1,
                        itemsCustom: [
                            [0, 1],
                            [392, 2],
                            [596, 3],
                            [751, 2],
                            [975, 3],
                            [1183, 3],
                            [1440, 3],
                            [1728, 3]
                        ]
                    }), e("#testimonials-slider").length && e("#testimonials-slider").owlCarousel({
                        singleItem: !0,
                        autoHeight: !0,
                        mouseDrag: !1,
                        transitionStyle: "fade"
                    }), e("#featured-properties-slider").length && (e(".fullwidthsingle .item").each(function() {
                        var t = e(this);
                        e(".image", t).css({
                            "background-image": "url(" + e(".image img", t).attr("src") + ")"
                        }), e(".image img", t).remove()
                    }), e("#featured-properties-slider").owlCarousel({
                        singleItem: !0,
                        autoHeight: !0,
                        mouseDrag: !1,
                        transitionStyle: "fade"
                    })), e("#latest-properties-slider").length && (e(".fullwidthsingle2 .item").each(function() {
                        var t = e(this);
                        e(".image", t).css({
                            "background-image": "url(" + e(".image img", t).attr("src") + ")"
                        }), e(".image img", t).remove()
                    }), e("#latest-properties-slider").owlCarousel({
                        navigation: !0,
                        navigationText: !1,
                        pagination: !1,
                        singleItem: !0,
                        autoHeight: !0
                    })), e("#latest-news-slider").length && (e(".latest-news-slider .item").each(function() {
                        var t = e(this);
                        e(".image", t).css({
                            "background-image": "url(" + e(".image img", t).attr("src") + ")"
                        }), e(".image img", t).remove()
                    }), e("#latest-news-slider").owlCarousel({
                        singleItem: !0,
                        autoHeight: !0,
                        mouseDrag: !1,
                        transitionStyle: "fade"
                    })), e("#twitter-slider").length && e("#twitter-slider").owlCarousel({
                        singleItem: !0,
                        autoHeight: !0,
                        mouseDrag: !1,
                        transitionStyle: "fade"
                    }), e("#property-detail-large").length && e("#property-detail-thumbs").length) {
                    var t = e("#property-detail-large"),
                        i = e("#property-detail-thumbs"),
                        a = function(e) {
                            var t, a = i.data("owlCarousel").owl.visibleItems,
                                o = e,
                                n = !1;
                            for (t = 0; t < a.length - 1; t += 1) o === a[t] && (n = !0);
                            n === !1 ? o > a[a.length - 1] ? i.trigger("owl.goTo", o - a.length + 2) : (o - 1 === -1 && (o = 0), i.trigger("owl.goTo", o)) : o === a[a.length - 1] ? i.trigger("owl.goTo", a[1]) : o === a[0] && i.trigger("owl.goTo", o - 1)
                        },
                        o = function() {
                            var t = this.currentItem;
                            e("#property-detail-thumbs").find(".owl-item").removeClass("synced").eq(t).addClass("synced"), void 0 !== i.data("owlCarousel") && a(t)
                        };
                    e(".item", i).each(function() {
                        var t = e(this);
                        t.css({
                            "background-image": "url(" + e("img", t).attr("src") + ")"
                        }), e("img", t).remove()
                    }), t.owlCarousel({
                        singleItem: !0,
                        slideSpeed: 1e3,
                        navigation: !1,
                        pagination: !1,
                        autoHeight: !0,
                        afterAction: o,
                        responsiveRefreshRate: 200
                    }), i.owlCarousel({
                        itemsCustom: [
                            [0, 2],
                            [300, 3],
                            [629, 4],
                            [751, 3],
                            [975, 4],
                            [1183, 5]
                        ],
                        pagination: !0,
                        responsiveRefreshRate: 100,
                        afterInit: function(e) {
                            e.find(".owl-item").eq(0).addClass("synced")
                        }
                    }), e("#property-detail-thumbs").on("click", ".owl-item", function(i) {
                        i.preventDefault();
                        var a = e(this).data("owlItem");
                        t.trigger("owl.goTo", a)
                    })
                }
            },
            createRevSlider: function() {
                e(".revslider").length && e(".revslider").revolution({
                    delay: 9e3,
                    startwidth: 1170,
                    startheight: 500,
                    hideThumbs: 10,
                    navigationType: "none",
                    fullWidth: "on"
                })
            },
            createSelectBoxes: function() {
                e("select").length && e("select").chosen({
                    allow_single_deselect: !0,
                    disable_search_threshold: 12
                })
            },
            createCheckBoxes: function() {
                e('input[type="checkbox"]').length && e('input[type="checkbox"]').checkbox({
                    checkedClass: "fa fa-check-square-o",
                    uncheckedClass: "fa fa-square-o"
                })
            },
            propertiesGrid: function() {
                if (e("#freewall").length) {
                    e("#freewall .item").each(function() {
                        var t = e(this);
                        t.width(Math.floor(200 + 200 * Math.random())), t.css({
                            "background-image": "url(" + e(">img", t).attr("src") + ")"
                        }), e(">img", t).remove()
                    });
                    var t = new Freewall("#freewall");
                    t.reset({
                        selector: ".item",
                        animate: !1,
                        cellW: 20,
                        cellH: 240,
                        gutterX: 1,
                        gutterY: 1,
                        onResize: function() {
                            t.fitWidth()
                        }
                    }), t.fitWidth()
                }
            },
            parallaxItems: function() {
                e.browser.mobile ? e(".parallax, #home-search-section").css({
                    "background-position": "50% 50%",
                    "background-size": "cover",
                    "background-attachment": "scroll"
                }) : e.stellar()
            },
            agencyMap: function(t, i, a) {
                if (void 0 === i || 0 === t.length) return !1;
                var o, n, s, l, r, c, d = this,
                    m = [],
                    p = [],
                    u = !1;
                for (null === d.agency_mapInitialLatitude && (d.agency_mapInitialLatitude = t[0].latitude), null === d.agency_mapInitialLongitude && (d.agency_mapInitialLongitude = t[0].longitude), void 0 !== a || null === a ? (n = new google.maps.LatLng(t[a].latitude, t[a].longitude), d.agency_initialZoom = d.agency_selectedZoom) : n = new google.maps.LatLng(d.agency_mapInitialLatitude, d.agency_mapInitialLongitude), this.use_default_map_style || (m = [{
                        featureType: "all",
                        elementType: "all",
                        stylers: [{
                            saturation: -100
                        }]
                    }]), o = new google.maps.StyledMapType(m, {
                        name: "Cozy"
                    }), s = {
                        center: n,
                        zoom: d.agency_initialZoom,
                        scrollwheel: !1,
                        panControl: !1,
                        mapTypeControl: !1,
                        zoomControl: !0,
                        zoomControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        }
                    }, l = new google.maps.Map(document.getElementById(i), s), l.mapTypes.set("map_style", o), l.setMapTypeId("map_style"), r = function(t) {
                        var i, a = t.latitude,
                            o = t.longitude,
                            n = new google.maps.Marker({
                                position: new google.maps.LatLng(a, o),
                                map: l,
                                icon: t.map_marker_icon
                            }),
                            s = '<div class="infoWindowAgency"><h3>' + t.title + '</h3><a href="' + t.link + '"><img src="' + t.image + '" alt="' + t.title + '"></a><div class="description">' + t.description + "</div>";
                        s += "" !== t.link && void 0 !== t.link ? '<div class="center"><a class="btn btn-fullcolor" href="' + t.link + '">' + d.agency_viewMore + "</a></div></div>" : "</div>", i = {
                            content: s,
                            zIndex: null,
                            alignBottom: !0,
                            pixelOffset: new google.maps.Size(-85, -62),
                            closeBoxMargin: "10px 10px 10px 10px",
                            closeBoxURL: "images/close_infobox.png",
                            infoBoxClearance: new google.maps.Size(5, 5),
                            isHidden: !1,
                            pane: "floatPane",
                            enableEventPropagation: !1
                        }, p.push(n), p[p.length - 1].infobox = new InfoBox(i), google.maps.event.addListener(n, "click", function() {
                            e.each(p, function() {
                                this.infobox.close()
                            }), this.infobox.open(l, this)
                        })
                    }, e("#" + i).parent().parent().find("#agency").length > 0 && (u = !0), c = 0; c < t.length; c += 1) void 0 !== t[c] && (r(t[c]), u && e("#agency").append(e("<option></option>").attr("value", c).text(t[c].title)));
                u && (e("#agency").trigger("liszt:updated"), e("#agency").chosen().change(function() {
                    var i = e("#agency").val();
                    return "" === i ? (l.setZoom(d.agency_initialZoom), !1) : (l.setCenter(new google.maps.LatLng(t[i].latitude, t[i].longitude)), void l.setZoom(d.agency_selectedZoom))
                }))
            },
            propertiesMap: function(e, t, i) {
                var a, o, n, s, l, r, c, d, m, p = this,
                    u = {},
                    g = [];
                for (u.pics = null, u.map = null, u.markerClusterer = null, u.markers = [], u.infoWindow = null, this.use_default_map_style || (g = [{
                        featureType: "all",
                        elementType: "all",
                        stylers: [{
                            saturation: -100
                        }]
                    }]), a = new google.maps.StyledMapType(g, {
                        name: "Cozy"
                    }), void 0 !== i || null === i ? (o = new google.maps.LatLng(e[i].latitude, e[i].longitude), p.properties_initialZoom = p.properties_selectedZoom) : o = new google.maps.LatLng(p.properties_mapInitialLatitude, p.properties_mapInitialLongitude), n = {
                        zoom: p.properties_initialZoom,
                        center: o,
                        scrollwheel: !1
                    }, u.map = new google.maps.Map(document.getElementById(t), n), u.map.mapTypes.set("map_style", a), u.map.setMapTypeId("map_style"), u.pics = e, u.infoWindow = new google.maps.InfoWindow({
                        pixelOffset: new google.maps.Size(0, -45)
                    }), s = function(e, t) {
                        return function(i) {
                            i.cancelBubble = !0, i.returnValue = !1, i.stopPropagation && (i.stopPropagation(), i.preventDefault());
                            var a = '<div class="infoWindow"><h3>' + e.title + '</h3><a href="' + e.link + '"><img src="' + e.image + '" alt="' + e.title + '"></a><div class="description">' + e.description + "</div>";
                            a += "" !== e.link && void 0 !== e.link ? '<div class="right"><a class="btn btn-fullcolor" href="' + e.link + '">' + p.properties_viewMore + "</a></div></div>" : "</div>", u.infoWindow.setContent(a), u.infoWindow.setPosition(t), u.infoWindow.open(u.map)
                        }
                    }, l = 0; l < u.pics.length; l += 1) r = new google.maps.LatLng(u.pics[l].latitude, u.pics[l].longitude), c = new google.maps.Marker({
                    position: r,
                    map: u.map,
                    icon: u.pics[l].map_marker_icon
                }), d = s(u.pics[l], r), google.maps.event.addListener(c, "click", d), u.markers.push(c);
                m = {
                    styles: [{
                        height: 52,
                        url: p.properties_cluster_marker,
                        width: 35,
                        textColor: p.properties_cluster_textcolor,
                        anchorText: [-10, 0],
                        textSize: 20,
                        fontWeight: "normal",
                        fontFamily: "Open Sans, Arial, sans-serif"
                    }, {
                        height: 52,
                        url: p.properties_cluster_marker,
                        width: 35,
                        textColor: p.properties_cluster_textcolor,
                        anchorText: [-10, 0],
                        textSize: 20,
                        fontWeight: "normal",
                        fontFamily: "Open Sans, Arial, sans-serif"
                    }, {
                        height: 52,
                        url: p.properties_cluster_marker,
                        width: 35,
                        textColor: p.properties_cluster_textcolor,
                        anchorText: [-10, 0],
                        textSize: 16,
                        fontWeight: "normal",
                        fontFamily: "Open Sans, Arial, sans-serif"
                    }],
                    maxZoom: 15
                }, u.markerClusterer = new MarkerClusterer(u.map, u.markers, m)
            },
            contactsMap: function(t, i, a) {
                var o, n, s, l, r, c, d, m = this,
                    p = [],
                    u = [];
                if (void 0 === i || 0 === t.length) return !1;
                for ((void 0 === a || null === a) && (a = 14), this.use_default_map_style || (p = [{
                        featureType: "all",
                        elementType: "all",
                        stylers: [{
                            saturation: -100
                        }]
                    }]), o = new google.maps.StyledMapType(p, {
                        name: "Cozy"
                    }), n = e(window).innerWidth() <= 751 ? t[0].longitude : t[0].longitude + .03, s = new google.maps.LatLng(t[0].latitude, n), l = {
                        center: s,
                        zoom: a,
                        scrollwheel: !1,
                        panControl: !1,
                        mapTypeControl: !1,
                        zoomControl: !0,
                        zoomControlOptions: {
                            position: google.maps.ControlPosition.LEFT_TOP
                        }
                    }, r = new google.maps.Map(document.getElementById(i), l), r.mapTypes.set("map_style", o), r.setMapTypeId("map_style"), c = function(t) {
                        var i, a = new google.maps.Marker({
                                position: new google.maps.LatLng(t.latitude, t.longitude),
                                map: r,
                                icon: t.map_marker_icon
                            }),
                            o = '<div class="infoWindowContacts"><h3>' + t.title + '</h3><img src="' + t.image + '" alt="' + t.title + '"><div class="description">' + t.description + "</div>";
                        o += "" !== t.link && void 0 !== t.link ? '<div class="center"><a class="btn btn-fullcolor" href="' + t.link + '">' + m.agency_viewMore + "</a></div></div>" : "</div>", i = {
                            content: o,
                            zIndex: null,
                            alignBottom: !0,
                            pixelOffset: new google.maps.Size(-85, -62),
                            closeBoxMargin: "10px 10px 10px 10px",
                            closeBoxURL: "images/close_infobox.png",
                            infoBoxClearance: new google.maps.Size(5, 5),
                            isHidden: !1,
                            pane: "floatPane",
                            enableEventPropagation: !1
                        }, u.push(a), u[u.length - 1].infobox = new InfoBox(i), google.maps.event.addListener(a, "click", function() {
                            e.each(u, function() {
                                this.infobox.close()
                            }), this.infobox.open(r, this)
                        })
                    }, d = 0; d < t.length; d += 1) void 0 !== t[d] && c(t[d])
            },
            windowResize: function() {
                var t = this;
                e(window).resize(function() {
                    var i = e(window).innerWidth();
                    t.resizeSidebar(i), t.createMobileMenu(i)
                })
            },
            stickyNav: function() {
                var t = e("#nav-section");
                t.waypoint("sticky"), e("body").waypoint(function(e) {
                    "down" === e ? t.addClass("shrink") : t.removeClass("shrink")
                }, {
                    offset: -320
                })
            },
            resizeSidebar: function(t) {
                null !== t && (t = e(window).innerWidth()), (e(".colored .sidebar").length || e(".gray .sidebar").length) && e(".sidebar").each(t >= 751 ? function() {
                    var t = e(this).closest(".content").find(".main").height();
                    e(this).css({
                        minHeight: t + 135 + "px"
                    })
                } : function() {
                    e(this).css({
                        "min-height": "0px"
                    })
                })
            },
            buttonsClick: function() {
                e("#home-search-buttons > .btn").bind("click", function() {
                    e("#home-search-buttons > .btn").removeClass("active"), e(this).addClass("active")
                }), e("#opensearch").bind("click", function() {
                    e("#home-advanced-search .container").css({
                        overflow: "hidden"
                    }), e("#home-advanced-search").toggleClass("open"), e("#home-advanced-search").hasClass("open") && setTimeout(function() {
                        e("#home-advanced-search .container").css({
                            overflow: "visible"
                        })
                    }, 400)
                });
                var t = !1,
                    i = 0,
                    a = 0;
                e("#filter-close").bind("click", function() {
                    var a = e(this);
                    return t ? !1 : (t = !0, void(a.hasClass("fa-minus") ? (a.removeClass("fa-minus").addClass("fa-plus"), i = e("#map-property-filter .row > div").height(), e("#map-property-filter .row > div").css({
                        overflow: "hidden"
                    }).animate({
                        height: "35px",
                        "margin-top": "-83px"
                    }, 300, function() {
                        e("form", this).css({
                            visibility: "hidden"
                        }), e(this).animate({
                            width: "42px"
                        }, 300), t = !1
                    })) : (a.removeClass("fa-plus").addClass("fa-minus"), e("#map-property-filter .row > div").animate({
                        width: "100%"
                    }, 300, function() {
                        e("form", this).css({
                            visibility: "visible"
                        }), e(this).animate({
                            height: i + "px",
                            "margin-top": "-200px"
                        }, 300, function() {
                            e(this).css({
                                overflow: "visible",
                                height: "auto"
                            }), t = !1
                        })
                    }))))
                }), e("#contacts-overlay-close").bind("click", function() {
                    var o = e(this);
                    return t ? !1 : (t = !0, void(o.hasClass("fa-minus") ? (o.removeClass("fa-minus").addClass("fa-plus"), i = e("#contacts-overlay").height(), a = e("#contacts-overlay").width(), e("#contacts-overlay").css({
                        overflow: "hidden"
                    }).animate({
                        height: "35px",
                        "margin-top": "-83px"
                    }, 300, function() {
                        e("ul", this).css({
                            visibility: "hidden"
                        }), e(this).animate({
                            width: "42px",
                            "min-width": "42px"
                        }, 300), t = !1
                    })) : (o.removeClass("fa-plus").addClass("fa-minus"), e("#contacts-overlay").animate({
                        "min-width": a + "px",
                        width: "auto"
                    }, 300, function() {
                        e("ul", this).css({
                            visibility: "visible"
                        }), e(this).animate({
                            height: i + "px",
                            "margin-top": "-200px"
                        }, 300, function() {
                            e(this).css({
                                overflow: "visible",
                                height: "auto"
                            }), t = !1
                        })
                    }))))
                }), e("[data-slide-to]").click(function(t) {
                    t.preventDefault();
                    var i = e("#" + e(this).data("slide-to")).offset().top;
                    return e("html, body").animate({
                        scrollTop: i - 40
                    }, 1e3, "easeInOutExpo"), !1
                }), e("[data-load-amount]").click(function(t) {
                    t.preventDefault();
                    var i = e(this),
                        a = i.data("load-amount"),
                        o = e("#" + i.data("grid-id")),
                        n = 0;
                    return e("div.disabled", o).each(function() {
                        a > n && e(this).css({
                            opacity: 0,
                            "margin-top": "-20px"
                        }).removeClass("disabled").animate({
                            opacity: 1,
                            "margin-top": "0px"
                        }, 500), n += 1
                    }), e("div.disabled", o).length || i.hide(), !1
                })
            },
            initCountUp: function() {
                var t, i = {
                        useEasing: !0,
                        useGrouping: !0,
                        separator: ",",
                        decimal: "."
                    },
                    a = [];
                e(".timer").each(function(t) {
                    var o = e(this);
                    o.attr("id", "timer" + t), a["timer" + t] = new CountUp("timer" + t, 0, parseInt(o.data("to"), 10), 0, 4.5, i)
                }), t = function() {
                    var t = e(window).scrollTop(),
                        i = e(window).height();
                    e(".timer").each(function() {
                        var o = e(this);
                        t + i >= o.offset().top && a[o.attr("id")].start()
                    })
                }, e(window).scroll(function() {
                    t()
                }), t()
            },
            contactForm: function() {
                var t = this;
                e(".submit_form").click(function(i) {
                    i.preventDefault();
                    var a, o, n, s, l, r = e(this),
                        c = r.closest("form"),
                        d = e("input, textarea", c),
                        m = 0,
                        p = /\S+@\S+\.\S+/,
                        u = "contact",
                        g = !1;
                    return d.each(function() {
                        var t = e(this);
                        "hidden" === t.attr("type") ? t.hasClass("subject") ? u += "&subject=" + t.val() : t.hasClass("fromName") || t.hasClass("fromname") ? u += "&fromname=" + t.val() : t.hasClass("fromEmail") || t.hasClass("fromemail") ? u += "&fromemail=" + t.val() : (t.hasClass("emailTo") || t.hasClass("emailto")) && (u += "&emailto=" + t.val()) : t.hasClass("required") && "" === t.val() ? (t.addClass("invalid"), g = !0) : "email" === t.attr("type") && "" !== t.val() && p.test(t.val()) === !1 ? (t.addClass("invalid"), g = !0) : "recaptcha_response_field" !== t.attr("id") && (t.removeClass("invalid"), t.hasClass("subject") ? (u += "&subject=" + t.val(), u += "&subject_label=" + t.attr("name")) : t.hasClass("fromName") || t.hasClass("fromname") ? (u += "&fromname=" + t.val(), u += "&fromname_label=" + t.attr("name")) : t.hasClass("fromEmail") || t.hasClass("fromemail") ? (u += "&fromemail=" + t.val(), u += "&fromemail_label=" + t.attr("name")) : (u += "&field" + m + "_label=" + t.attr("name"), u += "&field" + m + "_value=" + t.val(), m += 1))
                    }), u += "&len=" + m, a = function() {
                        var t = e("i", r).attr("class");
                        e("i", r).removeClass(t).addClass("fa fa-times").delay(1500).queue(function(i) {
                            e(this).removeClass("fa fa-times").addClass(t), i()
                        }), r.addClass("btn-danger").delay(1500).queue(function(t) {
                            e(this).removeClass("btn-danger"), t()
                        })
                    }, o = function() {
                        var t = e("i", r).attr("class");
                        e("i", r).removeClass(t).addClass("fa fa-check").delay(1500).queue(function(i) {
                            e(this).removeClass("fa fa-check").addClass(t), i()
                        }), r.addClass("btn-success").delay(1500).queue(function(t) {
                            e(this).removeClass("btn-success"), t()
                        })
                    }, n = function() {
                        e("i", r).removeClass("fa-cog fa-spin").addClass("fa-envelope"), r.removeClass("disabled")
                    }, g || t.sendingMail ? a() : (t.sendingMail = !0, e("i", r).removeClass("fa-envelope").addClass("fa-cog fa-spin"), r.addClass("disabled"), e("#recaptcha_response_field").length ? (s = Recaptcha.get_challenge(), l = Recaptcha.get_response(), e.ajax({
                        type: "POST",
                        url: "recaptcha/verify.php",
                        data: "captcha=" + l + "&challenge=" + s,
                        success: function(i) {
                            var s = JSON.parse(i);
                            e(".recaptcha_only_if_incorrect").hide(), 0 === s.status ? (e(".recaptcha_only_if_incorrect").show(), n(), a(), t.sendingMail = !1) : 1 === s.status && e.ajax({
                                type: "POST",
                                url: "contact.php",
                                data: u,
                                success: function(e) {
                                    n(), "ok" === e ? (o(), c[0].reset()) : a(), t.sendingMail = !1
                                },
                                error: function() {
                                    n(), a(), t.sendingMail = !1
                                }
                            }), Recaptcha.reload()
                        },
                        error: function() {
                            n()
                        }
                    })) : e.ajax({
                        type: "POST",
                        url: "contact.php",
                        data: u,
                        success: function(e) {
                            n(), "ok" === e ? (o(), c[0].reset()) : a(), t.sendingMail = !1
                        },
                        error: function() {
                            n(), a(), t.sendingMail = !1
                        }
                    })), !1
                })
            },
            viewModeSwitcher: function() {
                e(".view-mode ul > li").bind("click", function() {
                    var t = e(this),
                        i = t.data("target"),
                        a = t.data("view");
                    e(">li", e(this).parent()).each(function() {
                        e(this).removeClass("active")
                    }), t.addClass("active"), e("#" + i).children().animate({
                        opacity: 0
                    }, 300, function() {
                        e("#" + i).removeClass().addClass(a), e("#" + i).children().animate({
                            opacity: 1
                        }, 300)
                    })
                })
            },
            animateElems: function() {
                var t = function() {
                    e("[data-animation-delay]").each(function() {
                        var t = e(this),
                            i = e(window).scrollTop(),
                            a = e(window).height(),
                            o = parseInt(t.attr("data-animation-delay"), 10),
                            n = t.data("animation-direction");
                        return void 0 === n ? !1 : (t.addClass("animate-" + n), void(i + a >= t.offset().top && (isNaN(o) || 0 === o ? t.removeClass("animate-" + n).addClass("animation-" + n) : setTimeout(function() {
                            t.removeClass("animate-me").addClass("animation-" + n)
                        }, o))))
                    })
                };
                e(window).innerWidth() >= 751 && (e(window).scroll(function() {
                    t()
                }), t())
            }
        }, Cozy.init()
    })
}(jQuery);