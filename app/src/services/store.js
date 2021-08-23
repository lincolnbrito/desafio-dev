import Api from './api'

class StoreService extends Api {
    constructor () {
        super({ segment: 'stores' })
    }

    list() {
        return this.client.get('');
    }

}

export default new StoreService()
