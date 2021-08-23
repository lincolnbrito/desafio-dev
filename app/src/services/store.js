import Api from './api'

class StoreService extends Api {
    constructor () {
        super({ segment: 'stores' })
    }

    list() {
        return this.client.get('');
    }

    show(store) {
        return this.client.get(`/${store}`);
    }

}

export default new StoreService()
