<style>
    body {
        background: #f0f2f5;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin: 40px auto;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 16px;
        margin-bottom: 20px;
    }

    .post-form textarea {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 8px;
        resize: none;
        padding: 10px;
        font-size: 14px;
    }

    .post-form input[type="file"] {
        margin-top: 8px;
        font-size: 13px;
    }

    .post-form button {
        background: #1877f2;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        float: right;
        margin-top: 10px;
    }

    .post-form button:hover {
        background: #166fe5;
    }

    .post {
        display: flex;
        flex-direction: column;
    }

    .post-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #1877f2;
        color: white;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 16px;
    }

    .post-info {
        display: flex;
        flex-direction: column;
    }

    .post-author {
        font-weight: bold;
        font-size: 14px;
    }

    .post-time {
        font-size: 12px;
        color: gray;
    }

    .post-text {
        font-size: 15px;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .post img {
        width: 100%;
        border-radius: 8px;
        margin-top: 8px;
        object-fit: cover;
    }

    .post-actions {
        display: flex;
        justify-content: space-around;
        border-top: 1px solid #ddd;
        padding-top: 8px;
        margin-top: 10px;
        color: #65676b;
        font-size: 14px;
    }

    .post-actions button {
        background: none;
        border: none;
        cursor: pointer;
        color: #65676b;
        font-weight: bold;
    }

    .post-actions button:hover {
        color: #1877f2;
    }
</style>

<div class="container">
    {{-- Form feedback --}}
    {{--<div class="card post-form">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <textarea name="keterangan" rows="3" placeholder="Tulis feedback kamu..."></textarea>
            <input type="file" name="gambar" accept="image/*">
            <button type="submit">Kirim</button>
        </form>
        <div style="clear: both;"></div>
    </div>--}}

    {{-- List feedback --}}
    @foreach ($feedback as $item)
        <div class="card post">
            <div class="post-header">
                <div class="avatar">A</div>
                <div class="post-info">
                    <div class="post-author">Admin</div>
                    <div class="post-time">{{ $item->created_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="post-text">{{ $item->keterangan }}</div>

            @if ($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar feedback">
            @endif

            <div class="post-actions">
                <button>👍 Like</button>
                <button>💬 Comment</button>
            </div>
        </div>
    @endforeach
</div>
