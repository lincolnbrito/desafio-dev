import Api from './api'

class TransactionService extends Api {
    constructor () {
        super({ segment: 'stores' })
    }

    list(store) {
        return this.client.get(`${store}/transactions`);
    }

}

export default new TransactionService()
