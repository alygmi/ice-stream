import React from 'react';
import { createRoot } from 'react-dom/client';

const App = () => {
    return (
        <div className="min-h-screen bg-gray-900 text-white flex items-center justify-center">
            <div className="text-center">
                <h1 className="text-4xl font-bold text-blue-400 mb-4">Hello, React with Tailwind!</h1>
                <p className="text-lg text-gray-300">React dan Tailwind sudah terintegrasi di Laravel.</p>
            </div>
        </div>
    );
};

const container = document.getElementById('app');
const root = createRoot(container);
root.render(<App />);