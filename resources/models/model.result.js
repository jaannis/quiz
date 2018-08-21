export default class Result {
    constructor() {
        /**
         *$type {?number}
         * */
        this.id = null;
        /**
         *$type {?number}
         * */
        this.userId = null;
        /**
         *$type {?number}
         * */
        this.quizId = null;
        /**
         *$type {?number}
         * */
        this.score = null;
    }


    static fromArray(rawData) {
        let result = new Result();
        result.id = rawData.id;
        result.userId = rawData.userId;
        result.quizId = rawData.quizId;
        result.score = rawData.score;


        return result;
    }
}
