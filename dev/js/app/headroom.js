define(['headroom','headroom-jq'],function (Headroom) {
    console.log('Module headroom loaded.');
    window.Headroom = Headroom;
    $("nav").headroom({
        "tolerance": 5,
        "offset": 205,
        "classes": {
            "initial": "headroom-animated",
            "pinned": "slideDown",
            "unpinned": "slideUp"
        }
    });

});