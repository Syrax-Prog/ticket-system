
import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import './Login.css'

function Login() {
    const navigate = useNavigate()

    const [name, setName] = useState('')
    const [password, setPassword] = useState('')
    const [error, setError] = useState('')
    const [loading, setLoading] = useState(false)

    async function handleSubmit(e) {
        e.preventDefault()

        setError('')
        setLoading(true)

        try {
            // 1. Get CSRF cookie from Laravel
            await fetch('http://localhost:8000/sanctum/csrf-cookie', {
                credentials: 'include'
            })

            // 2. Read the XSRF token
            const xsrfCookie = document.cookie
                .split('; ')
                .find(cookie => cookie.startsWith('XSRF-TOKEN='))

            const xsrfToken = xsrfCookie
                ? decodeURIComponent(xsrfCookie.split('=').slice(1).join('='))
                : ''

            // 3. Send login credentials
            const response = await fetch('http://localhost:8000/api/login', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-XSRF-TOKEN': xsrfToken
                },
                body: JSON.stringify({
                    name: name,
                    password: password
                })
            })

            const data = await response.json()

            if (!response.ok) {
                throw new Error(
                    data.message || 'Invalid username or password'
                )
            }

            // 4. Login successful
            navigate('/dashboard')

        } catch (err) {
            setError(err.message)
        } finally {
            setLoading(false)
        }
    }

    return (
        <div className="system-login">
            <div className="system-login-card">
                <div className="system-login-title">
                    HELPDESK SYSTEM
                </div>

                {error && (
                    <div className="alert alert-danger">
                        {error}
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <label htmlFor="name" className="form-label">
                            Username
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            className="form-control"
                            placeholder="Enter username"
                            value={name}
                            onChange={e => setName(e.target.value)}
                            required
                        />
                    </div>

                    <div className="mb-4">
                        <label htmlFor="password" className="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            className="form-control"
                            placeholder="Enter password"
                            value={password}
                            onChange={e => setPassword(e.target.value)}
                            required
                        />
                    </div>

                    <button
                        type="submit"
                        className="btn btn-primary w-100"
                        disabled={loading}
                    >
                        {loading ? 'LOGGING IN...' : 'LOGIN'}
                    </button>
                </form>
            </div>
        </div>
    )
}

export default Login
