import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);
/**
 * $params {string} controllerName
 */
export default class Api {
    constructor(controllerName) {
        this.controllerName = controllerName;
    }

    /**
     *
     * @param {string}action
     * @param {{}} [params]
     * @return {AxiosPromise}
     */
    get(action, params) {
        return Vue.axios.get(this.buildUrl(action), params ? params : {})
    }

    /**
     *
     * @param {string}action
     * @param {{}} [params]
     * @return {AxiosPromise}
     */
    post(action, params) {
        return Vue.axios.post(this.buildUrl(action), params ? Api.parseParams(params) : {})

    }

    /**
     *
     * @param url
     * @return {string}
     */
    buildUrl(url) {
        return '/' + this.controllerName + '/' + url;

    }

    static parseParams(object) {
        let params = new URLSearchParams();
        for (let key in object) {
            params.append(key, object[key]);
        }
        return params;
    }
}