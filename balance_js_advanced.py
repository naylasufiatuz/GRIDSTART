from pathlib import Path
text = Path('tmp_sim.mjs').read_text(encoding='utf-8')
stack = []
state = ['normal']
escape = False
for i, ch in enumerate(text):
    s = state[-1]
    if s == 'normal':
        if ch == '"': state.append('double'); escape = False
        elif ch == "'": state.append('single'); escape = False
        elif ch == '`': state.append('template'); escape = False
        elif ch == '/':
            nxt = text[i+1] if i+1 < len(text) else ''
            if nxt == '/': state.append('linecomment')
            elif nxt == '*': state.append('blockcomment')
        elif ch == '{': stack.append(i)
        elif ch == '}':
            if stack: stack.pop()
            else: print('Extra closing at', i)
    elif s == 'double':
        if escape:
            escape = False
        elif ch == '\\':
            escape = True
        elif ch == '"':
            state.pop(); escape = False
    elif s == 'single':
        if escape:
            escape = False
        elif ch == '\\':
            escape = True
        elif ch == "'":
            state.pop(); escape = False
    elif s == 'template':
        if escape:
            escape = False
        elif ch == '\\':
            escape = True
        elif ch == '`':
            state.pop(); escape = False
        elif ch == '$' and i+1 < len(text) and text[i+1] == '{':
            state.append('templateexpr'); stack.append(i+1)
    elif s == 'templateexpr':
        if escape:
            escape = False
        elif ch == '\\':
            escape = True
        elif ch == '"':
            state.append('double'); escape = False
        elif ch == "'":
            state.append('single'); escape = False
        elif ch == '`':
            state.append('template'); escape = False
        elif ch == '/':
            nxt = text[i+1] if i+1 < len(text) else ''
            if nxt == '/': state.append('linecomment')
            elif nxt == '*': state.append('blockcomment')
        elif ch == '{':
            stack.append(i)
        elif ch == '}':
            if stack:
                stack.pop()
            if state[-1] == 'templateexpr':
                state.pop()
    elif s == 'linecomment':
        if ch == '\n': state.pop()
    elif s == 'blockcomment':
        if ch == '*' and i+1 < len(text) and text[i+1] == '/':
            state.pop()
print('STATE', state)
print('UNMATCHED', len(stack))
if stack:
    for idx in stack[-10:]:
        print('at', idx, repr(text[max(0,idx-40):idx+40]))
