var surveyValueChanged = function (survey, options) {
    // language changer
    if(options.hasOwnProperty('name') && options.name === "language") {
        var langCode = options.value.code;
        console.log("changing language to " + langCode);
        survey.locale = langCode;
    }
};

function saveProfileData(url, data){
    console.log("saving profile data via:" + url + data);
    console.log(data);

    $.ajax({
        url: url,
        type: 'POST',
        data: {data},
        success: function(result) {
            if(result.hasOwnProperty('languageChanged') && result.languageChanged) {
                window.location.reload();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('failed:' + thrownError.toString());
        }

    });
}
function post(path, params, method='post') {

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = params[key];

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}
Survey
    .StylesManager
    .applyTheme("modern");

