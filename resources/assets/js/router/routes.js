import Welcome from '../components/Welcome'
import Difficulty from '../components/Difficulty'
import Game from '../components/Game'
import Leaderboard from '../components/Leaderboard'

const routes = [
    {
        path: '/welcome',
        name: 'welcome',
        component: Welcome
    },
    {
        path: '/difficulty',
        name: 'difficulty',
        component: Difficulty
    },
    {
        path: '/game',
        name: 'game',
        component: Game
    },
    {
        path: '/leaderboard',
        name: 'leaderboard',
        component: Leaderboard
    }

]

export default routes
