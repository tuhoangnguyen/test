import React, { useState } from 'react';
import Editor from 'react-simple-wysiwyg';
import { useForm } from "react-hook-form"
import { toast } from 'react-toastify';
import { useNavigate } from 'react-router-dom';

const CreateBlog = () => {
    const [html, setHtml] = useState('');
    const [imageId, setImageId] = useState('');
    const navigate = useNavigate();

    function onChange(e) {
        setHtml(e.target.value);
      }
    
      const {
        register,
        handleSubmit,
        watch,
        formState: { errors },
      } = useForm();


      const handleFileChange = async (e) => {
        const file = e.target.files[0];
        const formData = new FormData();
        formData.append("image", file);

        const res = await fetch("http://localhost:8000/api/blog/save-temp-img/", {
            method: "POST",
            body: formData
        });

        const result = await res.json();

        if(result.status === false) {
            alert(result.errors.image);
            e.target.value = null;
        }

        console.log(result.data.id);
        setImageId(result.data.name);
        console.log(imageId);
      }

      const formSubmit = async (data) => {
        const newData = {...data, "description": html, "image": imageId};
        

        const res = await fetch("http://localhost:8000/api/blog/add", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newData)

        });

        toast("Blog added successfully");

        navigate("/");
      }


    return (
        <div className='container mb-5'>
            <div className='d-flex justify-content-between pt-5 mb-4'>
                <h4>Create Blog</h4>
                <a href='/' className='btn btn-dark'>Back</a>
            </div>
            <div className='card border-0 shadow-lg'>
                <form onSubmit={handleSubmit(formSubmit)}>
                    <div className='card-body'>
                        <div className='mb-3'>
                            <label htmlFor='' className='form-label'>Title</label>
                            <input {...register("title", {required: true})} type='text' className={`form-control ${errors.title && 'is-invalid'}`} placeholder='Title'></input>
                            {errors.title && <p className='invalid-feedback'>Title field is required</p>}
                        </div>
                        <div className='mb-3'>
                            <label htmlFor='' className='form-label'>Short Description</label>
                            <textarea {...register("shortDesc", {required: true})} className={`form-control ${errors.shortDesc && 'is-invalid'}`} cols={30} rows={10}></textarea>
                            {errors.shortDesc && <p className='invalid-feedback'>Short Description field is required</p>}
                        </div>
                        <div className='mb-3'>
                            <label htmlFor='' className='form-label'>Description</label>
                            <Editor containerProps={{ style: { resize: 'vertical', height: '400px' } }} value={html} onChange={onChange} />
                        </div>
                        <div className='mb-3'>
                            <label className='form-label'>Image</label> <br/>
                            <input onChange={handleFileChange} type='file'></input>
                        </div>
                        <div className='mb-3'>
                            <label htmlFor='' className='form-label'>Author</label>
                            <input {...register("author", {required: true})} type='text' className={`form-control ${errors.author && 'is-invalid'}`} placeholder='Author'></input>
                            {errors.author && <p className='invalid-feedback'>Author field is required</p>}
                        </div>
                        <button className='btn btn-dark'>Create</button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default CreateBlog;