import Api from './api'

class ImportService extends Api {
    constructor () {
        super({ segment: 'import' })
    }

    post(data) {
        return this.client.post('', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }

}

export default new ImportService()
