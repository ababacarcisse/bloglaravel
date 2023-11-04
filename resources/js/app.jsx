import './bootstrap';

import ReactDOM from 'react-dom/client';        
import Tasks from './components/tasks/Task';
import Header from './components/header';
import Create from './components/tasks/create';
import Update from './components/tasks/update';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

ReactDOM.createRoot(document.getElementById('app')).render(     
<div className="row">
    <div className="col-md-8 mx-auto">
        <BrowserRouter>
            <Header />
           <Routes>
           <Route path="/" exact element={<Tasks />} />
            <Route path="/create" exact element={<Create />} />
            <Route path="/edit/:taskId" exact element={<Update />} />
           </Routes>

        </BrowserRouter>
    </div>
</div>

    );