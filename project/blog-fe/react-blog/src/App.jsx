import { useState } from 'react'
import 'bootstrap/dist/css/bootstrap.min.css';
import BlogCard from './components/BlogCard';
import Blogs from './components/Blogs';
import { Route, Routes } from 'react-router-dom';
import CreateBlog from './components/CreateBlog';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

function App() {
 
  return (
    <>
       <div className='bg-dark text-center py-2 shadow-lg'>
          <h1 className='text-white'>Hoàng Tú đến chơi với React</h1>
        </div>
      <Routes>
         <Route path="/" element={<Blogs></Blogs>}></Route>
         <Route path="/create" element={<CreateBlog></CreateBlog>}></Route>
      </Routes>
      <ToastContainer />
    </>
  )
}

export default App
