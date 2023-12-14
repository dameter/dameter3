
let surveyValueChanged = function (survey, options) {
    // language changer
    //console.log(options);
    if(options.hasOwnProperty('name') && options.name === "language") {
        let langCode = options.value;
        console.log("changing language to " + langCode);
        survey.locale = langCode;
    }
};

Survey
    .StylesManager
    .applyTheme("modern");

