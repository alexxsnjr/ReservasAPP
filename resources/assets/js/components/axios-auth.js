import axios from 'axios'

const instance = axios.create({
  baseURL: 'http://aulas.app/api'
})

// instance.defaults.headers.common['SOMETHING'] = 'something'

export default instance