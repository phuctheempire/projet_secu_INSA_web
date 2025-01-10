import tkinter as tk
from tkinter import ttk
import glob


# 读取txt文件中的分数
def read_scores():
    try:
        with open("scores.txt", "r") as file:
            lines = file.readlines()
            total_score = int(lines[0].split(":")[1].strip())
            current_score = int(lines[1].split(":")[1].strip())
            return total_score, current_score
    except FileNotFoundError:
        print("File not found! Creating a default scores.txt...")
        with open("scores.txt", "w") as file:
            file.write("Total score: 100\nCurrent score: 0\n")
        return 100, 0
    except Exception as e:
        print(f"Error reading file: {e}")
        return 0, 0


# 更新进度条
def update_progress():
    total_score, current_score = read_scores()
    if total_score > 0:
        progress = (current_score / total_score) * 100
        progress_bar['value'] = progress
    if root.winfo_exists():  # 检查窗口是否存在
        root.after(3000, update_progress)  # 每10秒更新一次


# 更新倒计时
def update_countdown():
    global time_left
    if root.winfo_exists():  # 检查窗口是否存在
        if time_left > 0:
            time_left -= 1
            hours, remainder = divmod(time_left, 3600)
            minutes, seconds = divmod(remainder, 60)
            countdown_label.config(text=f"{hours} h {minutes} mins {seconds} sec")
            root.after(1000, update_countdown)
        else:
            countdown_label.config(text="Time's up!")


# 更新GIF动图
def update_gif(frame_index):
    global gif_image
    gif_image = tk.PhotoImage(file=frames[frame_index])
    gif_label.configure(image=gif_image)
    frame_index = (frame_index + 1) % len(frames)  # 循环播放帧
    if root.winfo_exists():  # 检查窗口是否存在
        gif_label.after(50, update_gif, frame_index)



# 提交问题到文件
def submit_question():
    question = question_entry.get().strip()
    if question:
        try:
            with open("scores.txt", "r") as file:
                lines = file.readlines()

            with open("scores.txt", "w") as file:
                for line in lines:
                    if line.startswith("Question:"):
                        file.write(f"Question: {question}\n")
                    else:
                        file.write(line)
            question_label.config(text=f"Question: {question}")
            question_entry.delete(0, tk.END)
        except Exception as e:
            print(f"Error writing to file: {e}")

def update_answer():
    try:
        # 读取答案
        with open("scores.txt", "r") as file:
            lines = file.readlines()
            answer = ""
            for line in lines:
                if line.startswith("Answer:"):
                    answer = line.split(":", 1)[1].strip()
                    break
            if not answer:
                answer = "No answer yet"  # 默认答案
    except FileNotFoundError:
        print("File not found! Creating a default scores.txt...")
        with open("scores.txt", "w") as file:
            file.write("Total Score: 100\nCurrent Score: 0\nAnswer: No answer yet\n")
        answer = "No answer yet"
    except Exception as e:
        print(f"Error reading file: {e}")
        answer = "Error"

    # 更新文本框内容
    answer_text.delete(1.0, tk.END)  # 清空现有内容
    answer_text.insert(tk.END, f"Answer: {answer}")  # 插入新的答案

    # 定时更新
    if root.winfo_exists():  # 检查窗口是否存在
        root.after(3000, update_answer)  # 每10秒更新一次

def update_record():
    try:
        # 读取历史记录（这里假设是从一个文件获取）
        with open("client_record.txt", "r") as file:
            records = file.readlines()

        # 更新 Text 控件，显示所有历史记录
        record_text.delete(1.0, tk.END)  # 清空现有内容
        for record in records:
            record_text.insert(tk.END, record)  # 插入新的记录
    except FileNotFoundError:
        print("File not found! Creating a default client_record.txt...")
        with open("client_record.txt", "w") as file:
            file.write("No records yet.\n")
        record_text.insert(tk.END, "No records yet.\n")
    except Exception as e:
        print(f"Error reading record file: {e}")

    # 定时更新
    if root.winfo_exists():  # 检查窗口是否存在
        root.after(20000, update_record)  

# 创建图形界面
root = tk.Tk()
root.title("Progress Bar Example")
root.geometry("800x600")

# 创建标签
label = tk.Label(root, text="Progress of your score", font=("Arial", 14))
label.pack(pady=10)

# 创建进度条
progress_bar = ttk.Progressbar(root, orient="horizontal", length=300, mode="determinate")
progress_bar.pack(pady=20)

# 初始化倒计时为两小时（7200秒）
time_left = 2 * 60 * 60

# 创建倒计时标签
countdown_label = tk.Label(root, text="02 h 00 mins 00 sec", font=("Arial", 14))
countdown_label.pack(pady=10)

# 加载GIF帧
frames = [
    f"GUI_asset/squelette/177a1121f3554a82883fe64c06a5340bPMb44m0BwrpgCzj6-{i}.png" 
    for i in range(33)  # 从 0 到 32
]


gif_image = tk.PhotoImage(file=frames[0])
gif_label = tk.Label(root, image=gif_image)
gif_label.pack(pady=10)

frame = tk.Frame(root, bg="lightgray", bd=2, relief="groove")
frame.place(relx=1.0, rely=0.0, anchor="ne", x=-50, y=180, width=200, height=100)

# 创建滚动条
scrollbar = tk.Scrollbar(frame)
scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

# 创建Text控件，支持滚动，命名为answer_text
answer_text = tk.Text(frame, font=("Arial", 12), wrap="word", height=5, width=20, bg="lightgray", yscrollcommand=scrollbar.set)
answer_text.pack(fill="both", expand=True)

# 配置滚动条与Text控件的连接
scrollbar.config(command=answer_text.yview)

# 创建显示记录的Frame
record_frame = tk.Frame(root, bg="lightgray", bd=2, relief="groove")
record_frame.place(relx=1.0, rely=0.0, anchor="center", x=-650, y=280, width=200, height=300)

# 创建滚动条
record_scrollbar = tk.Scrollbar(record_frame)
record_scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

# 创建Text控件，支持滚动，命名为record_text
record_text = tk.Text(record_frame, font=("Arial", 12), wrap="word", height=6, width=30, bg="lightgray", yscrollcommand=record_scrollbar.set)
record_text.pack(fill="both", expand=True)

# 配置滚动条与Text控件的连接
record_scrollbar.config(command=record_text.yview)

# 创建问题标签
question_label = tk.Label(root, text="Question: ", font=("Arial", 14))
question_label.pack(pady=10)

# 创建输入框和提交按钮
question_entry = tk.Entry(root, font=("Arial", 14))
question_entry.pack(pady=5)

submit_button = tk.Button(root, text="Submit Question", font=("Arial", 14), command=submit_question)
submit_button.pack(pady=5)

# 启动功能
update_progress()
update_countdown()
update_gif(0)
update_record()

update_answer()
# 启动主循环
root.mainloop()
