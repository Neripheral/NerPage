jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: base_url+'components/Main.js',
        dataType: 'script',
        success: callback,
        async: true
    });
}
