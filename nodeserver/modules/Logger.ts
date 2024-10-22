'use strict'
import DateHelper from "./DateHelper.js";
export default class Logger {
    static log(message: string) {
        console.log(DateHelper.dateString() + " " + message);
    }
}
