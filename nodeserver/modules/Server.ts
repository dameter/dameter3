'use strict';
import * as dotenv from 'dotenv';
import express from "express";
import Logger from "./Logger";
import * as SurveyJs from "survey-core"

export default class Server {

    constructor() {
        Logger.log("hello");

        dotenv.config({ override: true });

        const app = express();
        app.use(express.json());
        app.use(express.urlencoded({ extended: true,limit: '50mb'}))

        const port = process.env.port;
        Logger.log("hello"+port);

        app.listen(port, () => {
          Logger.log(`Example app listening on port ${port}`)
        });

        app.post('/', (req, res) => {
          Logger.log("Serving hello post!");
          console.log(req.body);
          res.send('Hello World ---!');
        });


      app.post('/response/check-quota', (req, res) => {
        const post= req.body;
        const responseData = JSON.parse(post.responseData);
        const conditions = JSON.parse(post.conditions);
        Logger.log(conditions);

        const condition = conditions[0];

        Logger.log(condition);

        let result = this.checkResponse(condition, responseData.attributes);
        res.send('Check quota:'+result );
      });


    }

  async checkResponse(condition: string, surveyData:string) : Promise<boolean>
  {

    console.log("init survey")
    const surveyJs = new SurveyJs.SurveyModel({})
    console.log("init runner")
    const runner = new SurveyJs.ExpressionRunner(condition);
    console.log(condition);
    console.log("loading survey data")
    surveyJs.data = surveyData
    let result = runner.run(surveyJs.data);
    console.log("result following")
    console.log(result)
    return result;

  }





}
export {Server}


