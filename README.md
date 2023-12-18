## NB! this is WORK IN PROGRESS

# Respund Collector: Open survey software based on SurveyJs 

Respund Collector is a survey data collection software based on SurveyJs library and PHP (yii2).

  - questionnaire is run my SurveyJs
  - Survey logic is stored and edited as SurveyJs json objects. Form builder is not included we assume the survey logic (json) is written programmed out of this projects scope and imported here as json.
  - Responses stored as json. No column-per question limitations.
  - Minimal Admin UI & functionality. Only focus on collecting, the invitations, sampling, analysis is out of scope for this module.
  - Provide API for external tools.


# dev installation

## docker-compose
quick dev installation via docker-compose

```$ docker-compose up -d ```

will serve on http://localhost:8011

##  run installation scripts
run the installation scripts on php container
```$ docker exec -it respund_php ash ```
```$ composer create-project ```
```$ composer install ```

The latter should also call & run all migrations using the default db container as databse 

##  import a survey json
copy a SurveyJs json as a json file to @runtime/surveys folder eg @runtime/surveys/my-survey.json
import the survey from the file via cmd:
```$ php yii test/create-survey my-survey ```

##  create a manually keyed respondent for the survey
```$ php yii test/create-respondent my-survey my-respondent-1 ```

## open the respondent's (personal/tokenized) survey for filling
http://localhost:8011/go/my-respondent-1


# Missing / TODO (no particular order)
Quotas. Quota criteria based on surveyJs::conditional-logic
Question / Page Randomization 
Data export
Theme management
RBAC
Basic Admin UI
Tests
