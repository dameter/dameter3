
let surveyValueChanged = function (survey, options) {
    // language changer
    //console.log(options);
    if(options.hasOwnProperty('name') && options.name === "language") {
        let langCode = options.value;
        console.log("changing language to " + langCode);
        survey.locale = langCode;
    }
};

function saveData(url, data){
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