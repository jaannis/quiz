export default class UserAnswer {
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
        this.answerId = null;
        /**
         *$type {?number}
         * */
        this.questionId = null;
    }

    static fromArray(rawData) {
        let userAnswer = new UserAnswer();
        userAnswer.id = rawData.id;
        userAnswer.userId = rawData.userId;
        userAnswer.quizId = rawData.quizId;
        userAnswer.answerId = rawData.answerId;
        userAnswer.questionId = rawData.questionId;


        return userAnswer;
    }
}

