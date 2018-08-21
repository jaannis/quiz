export default class User {
    constructor() {
        /**
         *$type {?number}
         * */
        this.id = null;
        /**
         *$type {name}
         * */
        this.name = '';
    }

    static fromArray(rawData) {
        let user = new User();
        user.id = rawData.id;
        user.name = rawData.name;

        return user;
    }
}