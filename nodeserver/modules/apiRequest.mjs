'use strict';
import * as dotenv from "dotenv";
import Logger from "./Logger.js";

export default class ApiRequest {

    postApiMessage(data){
        dotenv.config();
        let webAppAddress = process.env.webAppAddress;
        let webAppAuthToken = process.env.api_access_token;
        Logger.log("posting the message to back-end: ");

    }


}

