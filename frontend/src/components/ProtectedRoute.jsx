import { useEffect, useState } from 'react'
import { Navigate } from 'react-router-dom'

function ProtectedRoute({ children }) {
    const [authenticated, setAuthenticated] = useState(null)

    useEffect(() => {
        async function checkAuth() {
            try {
                const response = await fetch('http://localhost:8000/api/user', {
                    credentials: 'include',
                    headers: {
                        'Accept': 'application/json'
                    }
                })

                setAuthenticated(response.ok)
            } catch (error) {
                console.error('Authentication check failed:', error)
                setAuthenticated(false)
            }
        }

        checkAuth()
    }, [])

    if (authenticated === null) {
        return <div className="text-center mt-5">Checking authentication...</div>
    }

    if (!authenticated) {
        return <Navigate to="/login" replace />
    }

    return children
}

export default ProtectedRoute